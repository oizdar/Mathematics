<?php
namespace Task\Tests;

require('Matrix.php');
use PHPUnit\Framework\TestCase;
use \Task\Matrix;

class MatrixTest extends TestCase
{

    public function setUp()
    {
        $this->matrix = new Matrix([
            0 => [1, 1, 1, 1],
            1 => [1, 1, 1, 1],
            2 => [1, 1, 1, 1],
            3 => [1, 1, 1, 1]
        ]);
        $this->matrix2 = new Matrix([
            0 => [2, 2, 2, 2],
            1 => [2, 2, 2, 2],
            2 => [2, 2, 2, 2],
            3 => [2, 2, 2, 2]
        ]);
        $this->matrix4 = new Matrix([
            0 => [4, 4, 4, 4],
            1 => [4, 4, 4, 4],
            2 => [4, 4, 4, 4],
            3 => [4, 4, 4, 4]
        ]);
        $this->matrix8 = new Matrix([
            0 => [8, 8, 8, 8],
            1 => [8, 8, 8, 8],
            2 => [8, 8, 8, 8],
            3 => [8, 8, 8, 8]
        ]);
    }
    public function testCreateMatrix()
    {
        $matrix = new Matrix();
        $this->AssertInstanceOf('\Task\Matrix', $matrix);
    }

    public function testToString()
    {
        $string = "|1, 1, 1, 1|\n|1, 1, 1, 1|\n|1, 1, 1, 1|\n|1, 1, 1, 1|\n";
        $this->assertEquals($string, $this->matrix->toString());
    }

    public function testAddMatrix()
    {
        $newMatrix = $this->matrix->add($this->matrix);
        $this->assertEquals($this->matrix2, $newMatrix);
    }
    public function testSubstractMatrix()
    {
        $newMatrix = $this->matrix2->substract($this->matrix);
        $this->assertEquals($this->matrix, $newMatrix);
    }

    public function testMultiply()
    {
        $newMatrix = $this->matrix->multiply(2);
        $this->assertEquals($this->matrix2, $newMatrix);

        $matrixByMatrix = $this->matrix->multiply($this->matrix2);
        $this->assertEquals($this->matrix8, $matrixByMatrix);

        $matrix = new Matrix([
            0 => [1, 2, 3],
            1 => [4, 5, 6]
        ]);
        $matrix2 = new Matrix([
            0 => [7, 8],
            1 => [9, 10],
            2 => [11, 12]
        ]);
        $matrix3 = new Matrix([
            0 => [58, 64],
            1 => [139, 154],
        ]);

        $multiplied = $matrix->multiply($matrix2);
        $this->assertEquals($matrix3, $multiplied);


    }

    public function testDeterminant()
    {
        $matrix = new Matrix([
            0 => [6, 1, 1],
            1 => [4, -2, 5],
            2 => [2, 8, 7]
        ]);
        $determinant = $matrix->getDeterminant($matrix->getMap());
        $this->assertEquals(-306, $determinant);

        $matrix = new Matrix([
            0 => [4, 6],
            1 => [3, 8],
            ]);
        $determinant = $matrix->getDeterminant($matrix->getMap());
        $this->assertEquals(14, $determinant);

        $matrix = new Matrix([
            0 => [2, 0, 0, 0],
            1 => [0, 2, 0, 5],
            2 => [0, 2, 2, 0],
            3 => [0, 0, 0, 2],
        ]);
        $determinant = $matrix->getDeterminant($matrix->getMap());
        $this->assertEquals(16, $determinant);

    }

    public function testDivide()
    {
        $matrix = new Matrix([
            0 => [118.4, 135.2],
            ]);
        $matrixDivisor = new Matrix([
            0 => [3, 3.2],
            1 => [3.5, 3.6]
        ]);
        $division = new Matrix([0 => [16, 22]]);
        $newMatrix = $matrix->divide($matrixDivisor);
        $this->assertEquals($division, $newMatrix);
    }

    public function testTranspose()
    {
        $matrix = new Matrix([
            0 => [2, 0, 0, 0],
            1 => [0, 2, 0, 5],
            2 => [0, 2, 2, 0],
            3 => [0, 0, 0, 2],
        ]);
        $transposed = new Matrix([
            0 => [2, 0, 0, 0],
            1 => [0, 2, 2, 0],
            2 => [0, 0, 2, 0],
            3 => [0, 5, 0, 2],
        ]);

        $newMatrix = $matrix->transpose();
        $this->assertEquals($transposed, $newMatrix);
    }

    public function testMatrixOfMinors()
    {
        $matrix = new Matrix([
            0 => [3, 0, 2],
            1 => [2, 0, -2],
            2 => [0, 1, 1]
        ]);
        $newMatrix = $matrix->matrixOfMinors();
        $matrix2 = new Matrix([
            0 => [2,2, 2],
            1 => [-2, 3, 3],
            2 => [0, -10, 0]
        ]);
        $this->assertEquals($matrix2, $newMatrix);
    }
    public function testMatrixOfCofactors()
    {
        $matrix =  new Matrix([
            0 => [2,2, 2],
            1 => [-2, 3, 3],
            2 => [0, -10, 0]
        ]);
        $newMatrix = $matrix->matrixOfCoFactors();
        $matrix2 = new Matrix([
            0 => [2,-2, 2],
            1 => [2, 3, -3],
            2 => [0, 10, 0]
        ]);
        $this->assertEquals($matrix2, $newMatrix);
    }

    public function testTransponse()
    {
        $matrix = new Matrix([
            0 => [2, -2, 2],
            1 => [2, 3, -3],
            2 => [0, 10, 0]
        ]);
        $matrix2 = new Matrix([
            0 => [2, 2, 0],
            1 => [-2, 3, 10],
            2 => [2, -3, 0]
        ]);
        $matrix = $matrix->transpose();
        $this->assertEquals($matrix2, $matrix);
    }
}
