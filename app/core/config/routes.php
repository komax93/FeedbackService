<?php

return array(
    '/user/register' => 'user/register', //UserController => actionRegister
    '/user/login' => 'user/login', //UserController => actionLogin
    '/user/logout' => 'user/logout', //UserController => actionLogout
    '/edit/([0-9]+)' => 'feedback/edit/$1', //FeedbackController => actionEdit/$1
    '/save' => 'feedback/save', //FeedbackController => actionSave
    '' => 'feedback/index',    // FeedbackController => actionIndex
);