<?php

class User
{
    protected $service;

    public function __construct()
    {
        $this->service = new Service();
    }

    public function doSomething()
    {
        $this->service->sayHi();
    }
}

class Service
{
    public function sayHi()
    {
        echo 'Hi!';
    }
}

$user = new User();
$user->doSomething(); #Hi!
