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

Tests run by command:  ./vendor/bin/simple-phpunit
