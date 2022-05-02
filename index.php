<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');

});

$f3->route('GET /breakfast', function () {
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

$f3->route('GET /lunch', function () {
    $view = new Template();
    echo $view->render('views/lunch.html');
});

$f3->route('GET /order', function () {
    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

$f3->route('POST /order2', function () {
    var_dump($_POST);
    $_SESSION['food'] = $_POST['food'];
    $_SESSION['meal'] = $_POST['meal'];

    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

$f3->route('POST /summary', function () {

    if(empty($POST['conds'])) {
        $conds = 'none selected';
    } else {
        $conds = implode(", ", $_POST['conds']);
    }
    $_SESSION['conds'] = $conds;

    $view = new Template();
    echo $view->render('views/orderSummary.html');
});

//Run f3
$f3->run();