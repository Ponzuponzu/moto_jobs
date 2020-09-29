## PHP EXAM


**Read the instructions carefully.**

1. Do both `PART 1` and `PART 2` of the exam.
2. Once done, push the code to your repository.
3. Paste the URL to the Application Form Response or email the link to `isaac.lim@r4pid.com` and `patricia.cesar@r4pid.com`

### PART 1

---
***Please make sure .htaccess is setup correctly so that index.php is not part of the URI***

***Please use **CODEIGNITER 3.X NOT 4** framework.***

***Import this [sql dump file](https://drive.google.com/open?id=1q1jVH065ppcXZgGv67MSTAs3TxohDAtU) to your local db.***


### `1. Create an endpoint that shows the organization structure.`

`/api/organization`

Response Format:
```
{
    "employeeNumber: "123",
    "name": "Isaac Lim",
    "jobTitle": "CEO",
    "employeeUnder: [
        {
            "employeeNumber": "456",
            "name": "Patricia Cesar",
            "jobTitle": "VP",
            "employeeUnder": [{}]
        }
    ]
}
```

---

### `2. Create an endpoint that shows each offices contains which employee.`

`/api/offices`

Response Format:
```
[
    {
        "officeCode": "1",
        "city": "San San Francisco",
        "employees": [
            {
                "employeeNumber": "123",
                "name": "Isaac Lim",
                "jobTitle": "CEO"
            }
        ]
    }
]
```
---

### `3. Create an endpoint for dashboard report where it shows total number of sales revenue of each product lines being shipped by each employee.`
The commission can be calculated based on productScale under products table. 
E.g if 30 quantity is sold at $136.00, and the productScale is 1:18, then the commission is $226.67 

`/api/sales_report/` *This endpoint shows the overall product sales*

`/api/sales_report/{{employeeNumber}}` *This endpoint shows individual employee's sales figure*

Response Format:
```
[
    {
        "employeeNumber: "123",
        "name": "Isaac Lim",
        "jobTitle": "CEO",
        "officeCode": "1",
        "city": "San Francisco",
        "totalCommision": 12345.99,
        "totalSales": 123456798,
        "productLines": [
            {
                "productLines": "Motorcycles",
                "textDescription": "Our motorcycles are state of the art replicas of classic as well as contemporary motorcycle legends such as Harley Davidson, Ducati and Vespa. Models contain stunning details such as official logos, rotating wheels, working kickstand, front suspension, gear-shift lever, footbrake lever, and drive chain. Materials used include diecast and plastic. The models range in size from 1:10 to 1:50 scale and include numerous limited edition and several out-of-production vehicles. All models come fully assembled and ready for display in the home or office. Most include a certificate of authenticity.",
                "commission": 12345.99,
                "quantity": 12345,
                "sales": 123456798,
                "products":[
                    {
                        "productCode": "S10_2016",
                        "productName": "1996 Moto Guzzi 1100i",
                        "quantity": 12345,
                        "sales": 123445678.99,
                        "numberOfCustomerBought": 124
                    }
                ]
            }
        ]
    }
]
```

---
### PART 2


### Please refer to [sample_cleanup.php](https://bitbucket.org/r4pidinc_exam/exam_php/src/master/sample_cleanup.php)
 