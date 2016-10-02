<?php

namespace Math\Tests;

require('../Operations/Operations.php');
use PHPUnit\Framework\TestCase;
use \Math\Operations;

class OperationsTest extends TestCase
{
    public function testMobius()
    {
        $this->assertEquals(0, Operations::mobiusFunction(9));
        $this->assertEquals(0, Operations::mobiusFunction(44));
        $this->assertEquals(0, Operations::mobiusFunction(98));
        $this->assertEquals(0, Operations::mobiusFunction(136));
        $this->assertEquals(0, Operations::mobiusFunction(156));   
    }
    
    public function testMobiusPlus()
    {
        $this->assertEquals(1, Operations::mobiusFunction(1));
        $this->assertEquals(1, Operations::mobiusFunction(6));
        $this->assertEquals(1, Operations::mobiusFunction(35));
        $this->assertEquals(1, Operations::mobiusFunction(177));
        $this->assertEquals(1, Operations::mobiusFunction(214));
    }

    public function testMobiusMinus()
    {
        $this->assertEquals(-1, Operations::mobiusFunction(3)); 
        $this->assertEquals(-1, Operations::mobiusFunction(23));
        $this->assertEquals(-1, Operations::mobiusFunction(78));
        $this->assertEquals(-1, Operations::mobiusFunction(157));
        $this->assertEquals(-1, Operations::mobiusFunction(191));
    }

    public function testMertensFunction()
    {
        $this->assertEquals(1, Operations::mertensFunction(1));
        $this->assertEquals(0, Operations::mertensFunction(2));
        $this->assertEquals(-1, Operations::mertensFunction(3));
        $this->assertEquals(-2, Operations::mertensFunction(5));
        $this->assertEquals(-1, Operations::mertensFunction(10));
        $this->assertEquals(-3, Operations::mertensFunction(50));
        $this->assertEquals(2, Operations::mertensFunction(95));
        $this->assertEquals(1, Operations::mertensFunction(100));
        $this->assertEquals(3, Operations::mertensFunction(344));
        $this->assertEquals(-23, Operations::mertensFunction(10000));
    }
}
