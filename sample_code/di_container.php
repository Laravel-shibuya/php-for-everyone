<?php
require_once dirname(__DIR__). '/src/vendor/autoload.php';
use Illuminate\Foundation\Application;

$app = new Illuminate\Foundation\Application(dirname(__DIR__));

class User
{
    protected $serviceOne;
    protected $serviceTwo;
    protected $serviceThree;

    public function __construct(ServiceInterface $serviceOne, ServiceInterface $serviceTwo, ServiceInterface $serviceThree)
    {
        $this->serviceOne = $serviceOne;
        $this->serviceTwo = $serviceTwo;
        $this->serviceThree = $serviceThree;
    }

    public function doSomething()
    {
        $this->serviceOne->sayHi();
        $this->serviceTwo->sayHi();
        $this->serviceThree->sayHi();
    }
}

/**
 * Interface ServiceInterface
 */
interface ServiceInterface
{
    public function sayHi();
}

class ServiceOne implements ServiceInterface
{
    public function sayHi()
    {
        echo 'Hi!One';
    }
}

class ServiceTwo implements ServiceInterface
{
    public function sayHi()
    {
        echo 'Hi!Two';
    }
}

class ServiceThree implements ServiceInterface
{
    public function sayHi()
    {
        echo 'Hi!Three';
    }
}

$app->bind('serviceOne', function () {
    return new ServiceOne();
});

$app->bind('serviceTwo', function () {
    return new ServiceTwo();
});

$app->bind('serviceThree', function () {
    return new ServiceThree();
});

$app->bind('User', function (Application $app) {
    $serviceOne = $app->make('serviceOne');;
    $serviceTwo = $app->make('serviceTwo');
    $serviceThree = $app->make('serviceThree');
    return new User($serviceOne, $serviceTwo, $serviceThree);
});

$app->make('User')->doSomething();