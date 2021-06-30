<?php


namespace App\Tests;


use App\Controller\QuestionlistController;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function testadd(){
        $list = new QuestionlistController();
        $result = $list->add(5,6);

        $this->assertEquals(11, $result );

    }

    public function testSubtract(){

        $list = new QuestionlistController();
        $result = $list->subtract(6,5);
        $this->assertEquals(1, $result );


    }

}