Hzs
===


**Hzs** is a wrapper for the [**Flight**](http://flightphp.com/) and the [**Sparrow**](https://github.com/mikecao/sparrow) frameworks.


Installation
-------------

To install **Hzs**, you have just to require the `hzs.php` file. Just launch the `dependencies` file to download the dependencies.

Flight needs as some special [installations instruction](http://flightphp.com/install), follow them, or juste copy-paste the `.htaccess` from the `example/` folder.

    require_once "path/to/hzs.php";


Database connection
--------

The database is handle by Sparrow (see [the doc](https://github.com/mikecao/sparrow#sparrow)).

    Hzs::setDb(array $arr);

###Example :

    Hzs::setDb(array(
        'hostname' => '',
        'database' => '',
        'username' => '',
        'password' => ''
    ));


Query and routing
-----

The routing method is similar the the Flight route system.

    Hzs::route(string $route, array $post, function $callback);

Where

 - `$route` is the path requested by the browser (see [the doc](http://flightphp.com/learn#routing)),
 - `$post` is an array listing all the requested variables. The values of thoses variables are fetched from the `$_POST` array,
 - `$callback` is the function to be executed.

The `$callback` function takes 3 arguments, a Sparrow object as the database, an array contening all the post data and an array contening the response to display. The callback function must return the response.

Note that the response array will be encoded to JSON, so you can put whatever you want in it.

###Example : 

    Hzs::route("/createUser", array(
        "name", "pass"
        ), function($db, $post, $res){
            $db->from("users")
                ->insert($post)
                ->execute();

            // not very usefull in this case
            $res["message"] = "user_added";

            // just to show
            $res["time"] = time();

            return $res;
        }
    );

When called, the `createUser` page will yield : 
    
    {
        "status":"ok",
        "message":"user_added",
        "route":"/createUser",
        "time": 797061600
    }

###Errors :

If some requested variables are missing from the `$_POST` array, the request will not work.

     {
        "status":"error",
        "message":"missing_post_data",
        "route":"/createUser"
    }


Start
-----

Like **Flight**, there is a start function.

    Hzs::start();


Options
-------

###Message :

Set the default and minimal message to display. This is what is passed to the callback function.

    Hzs::$message = array(
        "status" => "ok",
        "message" => "no-errors"
    );

###DisplayRoute :

Whether or not to display the requested route. (grammar ?)

    Hzs::$displayRoute = true;