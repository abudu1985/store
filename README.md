store
=====

A Symfony project created on July 26, 2018, 9:46 pm.

Route examples: http://localhost/store/web/app_dev.php/orders  (GET);

               http://localhost/store/web/app_dev.php/order   (POST); 
Parameters:   
{
  "name":"new order55",
  "user": {"id": 4},
  "items": [
    { "id":1, "qty":"6" },
    { "id":3, "qty":"3" },
    { "id":2, "qty": 2 }
  ]
}

it possible to see entities content following link  ../store/web/app_dev.php/admin

![alt text](https://github.com/abudu1985/store/blob/master/web/images/Selection_002.png)

Tests run by command:  ./vendor/bin/simple-phpunit

After refactoring (mapping and tests)

![alt text](https://github.com/abudu1985/store/blob/master/web/images/Selection_004.png)
