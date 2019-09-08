<?php
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
        // TODO: Implement sayHi() method.
        echo 'Hi!Three';
    }
}

$serviceOne = new ServiceOne();
$serviceTwo = new ServiceTwo();
$serviceThree = new ServiceThree();
$user = new User($serviceOne,$serviceTwo,$serviceThree);

$user->doSomething(); #Hi!OneHi!TwoHi!Three

