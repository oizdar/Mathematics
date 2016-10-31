<?php

namespace Math\Tests;

require('../Operations/Operations.php');

use PHPUnit\Framework\TestCase;
use \Math\Operations;

class OperationsTest extends \PHPUnit_Framework_TestCase
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

    public function testRPN()
    {
        $this->assertEquals(14, Operations::reversePolishNotation('5 1 2 + 4 * + 3 -'));
        $this->assertEquals(14, Operations::reversePolishNotation('6 3 / 2 5 + *'));
        $this->assertEquals(-35, Operations::reversePolishNotation('2 1 + 3 * 4 7 4 + * -'));
        $this->assertEquals(18.75, Operations::reversePolishNotation('2,5 3 2.5 * *'));
        $this->assertEquals(3, Operations::reversePolishNotation('3,3333 1.1111 /'));
    }

    public function testFactorial()
    {
        $this->assertEquals(1, Operations::factorial(1));
        $this->assertEquals(120, Operations::factorial(5));
        $this->assertEquals(3628800, Operations::factorial(10));
    }

    public function testFibonacci()
    {
        $this->assertEquals(0, Operations::fibonacci(0));
        $this->assertEquals(1, Operations::fibonacci(1));
        $this->assertEquals(4181, Operations::fibonacci(19));
        $this->assertEquals(7540113804746346429, Operations::fibonacci(92));
    }
}
