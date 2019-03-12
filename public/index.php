<?php
require_once __DIR__ . "/../vendor/autoload.php";

Toro::serve(array(
    "/" => "Controllers\\HomeController",
    "/signup"=>"Controllers\\SignupController",
    "/login"=>"Controllers\\LoginController",
    "/user"=>"Controllers\\UserController",
    "/admin"=>"Controllers\\AdminController",
    "/getdata"=>"Controllers\\GetDataController",
    "/logout"=>"Controllers\\LogoutController",
    "/getleader"=>"Controllers\\LeaderController"
));
?>