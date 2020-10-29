<?php

/*
TECHNICAL TEST

PURPOSE: It is to test your understanding on object oriented programming
WHAT TO DO: Normalize the code as much as possible so that it is scalable in the future if there were more to add on for similar functions
HINT: U may need to normalize a few iteration
*/

public function prepare_markets()
{
    $match_summary = $match['pbp_stats']['match_summary'];

    $this->settle_map_first($match_summary, 'first_blood', 'TEAM TO DRAW FIRST BLOOD');
    //
    $structures = [
        ['structure_id' => 'towers', 'caption' =>  'FIRST TOWERS DESTROYED LOCATION'],
        ['structure_id' => 'inhibitors', 'caption' => 'FIRST INHIBITOR DESTROYED LOCATION'],
    ];

    foreach ($structures as $key => $structure) {
        $this->settle_map_first_destroyed_location($match_summary, $structure['structure_id'], $objective['caption']);
    }

    //team stats
    $this->settle_map_total_gold_diff($match_summary);
    $this->settle_map_which_team_has_highest_gold($match_summary);
    $this->settle_map_team_with_most_assist_point($match_summary);
    
    //
    $events = [
        ['event_id' => 'dragons', 'caption' => 'TOTAL DRAGON SLAIN HANDICAP'],
        ['event_id' => 'dragons', 'caption' => 'TOTAL DRAGON SLAIN OVER/UNDER'],
        ['event_id' => 'dragons', 'caption' => 'TOTAL DRAGON SLAIN ODD/EVEN'],
        ['event_id' => 'barons', 'caption' => 'TOTAL BARON SLAIN HANDICAP'],
        ['event_id' => 'barons', 'caption' => 'TOTAL BARON SLAIN OVER/UNDER'],
        ['event_id' => 'barons', 'caption' => 'TOTAL BARON SLAIN ODD/EVEN'],
    ];

    foreach ($events as $key => $event) {
        $this->settle_map_total_slain($match_summary, $event['objective_id'], $event['caption']);
    }
    

    //
    $objectives = [
        ['objective_id' => 'first_tower', 'caption' => 'DESTROY FIRST TOWER'],
        ['objective_id' => 'first_rift_herald', 'caption' => 'DESTROY RIFT HERALD'],
        ['objective_id' => 'first_baron', 'caption' => 'DESTROY FIRST BARON'],
    ];

    foreach ($objectives as $key => $objective) {
        $this->settle_map_first($match_summary, $objective['objective_id'], $objective['caption']);
    }

}
/* ==============================*/

private function settle_map_first_destroyed_location($match_summary, $structure_id, $caption)
{
    $location = $match_summary['objective_events'][$structure_id][0]['lane'];
    if (!$location)
    {
        return;
    }

    $this->result["{$this->mapNumStr} {$caption}"] = $location;
}


/*=================*/

private function settle_map_total_gold_diff($match_summary)
{
    $teams_stat = $this->get_teams_stat($match_summary, 'gold_earned');

    $total_gold_diff = abs(round(($teams_stat['home'] - $teams_stat['away']) / 1000));

    $this->result["{$this->mapNumStr} TOTAL GOLD DIFFERENCE OVER/UNDER (IN THOUSANDS)"] = $total_gold_diff;
}

private function settle_map_which_team_has_highest_gold($match_summary)
{
    $teams_stat = $this->get_teams_stat($match_summary, 'gold_earned');

    $team_id = $this->team['home']['id'];
    if ($teams_stat['away'] > $teams_stat['home'])
    {
        $team_id = $this->team['away']['id'];
    }

    $this->result["{$this->mapNumStr} WHICH TEAM HAVE HIGHEST GOLD"] = $team_id;
}

private function settle_map_team_with_most_assist_point($match_summary)
{
    $teams_stat = $this->get_teams_stat($match_summary, 'assists');

    $team_id = $this->team['home']['id'];
    if ($teams_stat['away'] > $teams_stat['home'] )
    {
        $team_id = $this->team['away']['id'];
    }

    $this->result["{$this->mapNumStr} TEAM WITH MOST ASSIST POINT"] = $team_id;
}
/* ============================ */

private function settle_map_total_slain($match_summary, $events, $caption)
{
    $events = $match_summary['objective_events'][$events];
    $scoreline = $this->common_event_score_line($events);
    $this->result["{$this->mapNumStr} {$caption}"] = $scoreline;
}

/*==================================*/

private function settle_map_first($match_summary, $first_id, $caption )
{
    $playe_id = $match_summary['firsts'][$first_id]['player_id'];
    if (!$playe_id)
    {
        return;
    }

    $team_id = $this->get_team_id($playe_id);
    $this->result["{$this->mapNumStr} {$caption}"] = $team_id;
}

private function get_team_id($playe_id)
{
    $team_id = $this->team['home']['id']; 
    if (!$this->is_player_home_team($playe_id))
    {
        $team_id = $this->team['away']['id'];
    }
    return $team_id;
}

private function get_teams_stat($match_summary, $stat)
{

    list($home, $away) = $this->get_home_away_team($match_summary);

    $home = array_sum(
        array_column($match_summary[$home]['players'], $stat)
    );
    $away = array_sum(
        array_column($match_summary[$away]['players'], $stat)
    );

    return ['home' => $home, 'away' => $away ];
}


/* ========================================= */
