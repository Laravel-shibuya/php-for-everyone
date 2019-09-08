<?php

class User
{
    protected $service;

    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    public function doSomething()
    {
        $this->service->sayHi();
    }
}

/**
 * Interface ServiceInterface
 */
interface ServiceInterface
{
    public function sayHi();
}

class Service implements ServiceInterface
{
    public function sayHi()
    {
        echo 'Hi!';
    }
}

$service = new Service();
$user = new User($service);
$user->doSomething(); #Hi!
