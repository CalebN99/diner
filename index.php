<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');

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

$f3->route('GET|POST /order', function ($f3) {


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (validFood($_POST['food'])) {
            $_SESSION['food'] = $_POST['food'];
            header('location: order2');
        } else {
            $f3->set('errors["food"]', 'Please enter a food at least 2 characters');
        }

        $_SESSION['meal'] = $_POST['meal'];

    }


    $f3->set('meals', getMeals());


    $view = new Template();
    echo $view->render('views/orderForm1.html');



});

$f3->route('GET|POST /order2', function ($f3) {


    $f3->set('condiments', getCondiments());

    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

$f3->route('GET|POST /summary', function () {

    if(empty($_POST['conds'])) {
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