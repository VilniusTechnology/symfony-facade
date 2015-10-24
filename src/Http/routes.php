<?php

/*
 * Created by PhpStorm.
 * User: lukasm - vilnius.technology
 * Date: 15.5.1
 * Time: 18.55
 */


Route::match(['get', 'post'], 'sfbInstall', 'ManagerController@interpreter');
Route::match(['get', 'post'], 'sfbInstall/run', 'ManagerController@run');