<?php
use Spirit\Route;

Route::add('/',['WelcomeController','index']);

require __DIR__ . '/auth.php';