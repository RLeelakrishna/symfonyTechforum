<?php


namespace App\Tests;


use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testReturnsFullName(){

        $user = new User();
        $user->setFirstName('LEELA');
        $this->assertEquals('LEELA',$user->getFirstName());
    }

}