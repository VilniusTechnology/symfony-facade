<?php

/*
 * Created by PhpStorm.
 * User: lukasm - vilnius.technology
 * Date: 15.5.1
 * Time: 18.55
 */


Route::match(['get', 'post'], 'interpreter', 'ManagerController@interpreter');
Route::match(['get', 'post'], 'blog/admin/run', 'ManagerController@run');