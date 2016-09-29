<?php

namespace Task;

class Matrix
{
    private $rows;
    private $columns;
    private $matrixMap = [];

    public function __construct(array $matrix = [])
    {
        if (empty($matrix)) {
            $this->createRandom();
        } else {
            $this->rows = count($matrix);
            $this->columns = count($matrix[0]);
            $this->matrixMap = $matrix;
        }
        return $this;
    }

    public function countRows() : int
    {
        return $this->rows;
    }

    public function countColumns() : int
    {
        return $this->columns;
    }

    public function getMap() : array
    {
        return $this->matrixMap;
    }

    private function createRandom(int $rows = 4, int $columns = 4)
    {
        $this->rows = $rows;
        $this->columns = $columns;

        $matrix =[];
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $matrix[$i][$j] = rand(-100, 100);
            }
        }
        $this->matrixMap = $matrix;
    }

    public function toString() : string
    {
        $string = '';
        for ($i = 0; $i < $this->rows; $i++) {
            $string .= '|';
            for ($j = 0; $j < $this->columns; $j++) {
                ($j>0)
                    ? $string .= ', ' . $this->matrixMap[$i][$j]
                    : $string .= $this->matrixMap[$i][$j];
            }
            $string .="|\n";
        }
        return $string;
    }

    public function add(Matrix $matrixToAdd) : Matrix
    {
        $newMatrix = [];
        if ($this->isSameSize($this, $matrixToAdd)) {
            $matrixToAdd = $matrixToAdd->getMap();
            for ($i = 0; $i < $this->rows; $i++) {
                for ($j = 0; $j < $this->columns; $j++) {
                    $newMatrix[$i][$j] =
                        $this->matrixMap[$i][$j]+$matrixToAdd[$i][$j];
                }
            }
            return new Matrix($newMatrix);
        }
        throw new Exception('Can add only same size Matrices');
        
    }
    private function isSameSize(Matrix $matrix, Matrix $matrix2) : bool
    {
        return
            ($matrix->countRows() === $matrix2->countRows()
            && $matrix->countColumns() === $matrix2->countColumns())
                ? true
                : false;
    }

    public function substract(Matrix $matrixToSubstract) : Matrix
    {
        $newMatrix = [];
        if ($this->isSameSize($this, $matrixToSubstract)) {
            $matrixToSubstract = $matrixToSubstract->getMap();
            for ($i = 0; $i < $this->rows; $i++) {
                for ($j = 0; $j < $this->columns; $j++) {
                    $newMatrix[$i][$j] =
                        $this->matrixMap[$i][$j]-$matrixToSubstract[$i][$j];
                }
            }
            return new Matrix($newMatrix);
        }
        throw new Exception('Can substract only same size Matrices');
        
    }

    public function multiply($multiplier) : Matrix
    {
        $newMatrix = [];
        if (is_int($multiplier)) {
            return $this->multiplyByNumber($multiplier);
        } elseif ($multiplier instanceof Matrix) {
            return $this->multiplyByMatrix($multiplier);
        } else {
            throw new Exception('Multiplier must be Integer or another Matrix Object');
        }
    }

    private function multiplyByNumber(float $multiplier) : Matrix
    {
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->columns; $j++) {
                $newMatrix[$i][$j] = $this->matrixMap[$i][$j]*$multiplier;
            }
        }
        return new Matrix($newMatrix);
    }

    private function multiplyByMatrix(Matrix $multiplier) : Matrix
    {
        $multiplierRows = $multiplier->countRows();
        $multiplierColumns = $multiplier->countColumns();
        if ($this->countColumns() === $multiplierRows) {
            $multiplier = $multiplier->getMap();
            for ($i = 0; $i < $this->rows; $i++) {
                for ($j = 0; $j < $multiplierColumns; $j++) {
                    $dotProduct = 0;
                    for ($k = 0; $k < $this->columns; $k++) {
                        $dotProduct +=
                            $this->matrixMap[$i][$k]*$multiplier[$k][$j];
                    }
                    $newMatrix[$i][$j] = $dotProduct;
                }
            }
            return new Matrix($newMatrix);
        }
        return new Exception('Number of multiplicand rows must be equal number of multiplier columns');
    }

    public function divide(Matrix $matrix) : Matrix
    {
        $inversedMatrix = $matrix->inverse();
        if ($matrix === false) {
            throw new Exception('Matrix have determinant equal 0');
        }
        $newMatrix = $this->multiplyByMatrix($inversedMatrix);

        return $newMatrix;
    }

    private function inverse() : Matrix
    {
        $determinant = $this->getDeterminant($this->matrixMap);
        if ($determinant !== 0) {
            if ($this->rows >2 || $this->columns >2) {
                $matrix = $this->matrixOfMinors();
            } else {
                $matrix = $this->swapCorners();
            }
            $matrix = $matrix->matrixOfCoFactors();
            $matrix = $matrix->transpose();
            return $matrix->multiplyByNumber((1/$determinant));
        }
        throw new Exception('Determinant is equal 0. Cannot inverse matrix');
    }
    private function swapCorners() : Matrix
    {
        $swaped = $this->matrixMap;
        $swaped[0][0] = $this->matrixMap[1][1];
        $swaped[1][1] = $this->matrixMap[0][0];

        return new Matrix($swaped);
    }

    public function getDeterminant(array $matrixMap, float $determinant = 0, $symbol = 1) : float
    {
        $rows = count($matrixMap);
        $columns = count($matrixMap[0]);
        if ($rows === $columns && $rows !== 1) {
            if ($rows == 2 && $columns == 2) {
                $determinant = $matrixMap[0][0] * $matrixMap[1][1]
                    - $matrixMap[0][1] * $matrixMap[1][0];

                return $determinant;
            } elseif ($rows > 2 && $columns > 2) {
                for ($i=0; $i<$columns; $i++) {
                    $newMatrixMap = $this->getSubMatrixMap($matrixMap, $i);
                    $sum =
                        $symbol
                        * $matrixMap[0][$i]
                        * $this->getDeterminant(
                            $newMatrixMap,
                            $determinant,
                            1
                        );
                        $determinant += $sum;
                    $symbol *= -1;
                }
                return $determinant;
            }
        }
        throw new Exception('Cannot calculate determinant. Matrix must be a square type.');
        
    }

    private function getSubMatrixMap(
        array $matrixMap,
        int $column,
        int $row = 0
    ) : array {
        $newMatrixMap = [];
        for ($i = 0; $i < count($matrixMap); $i++) {
            if ($i !== $row) {
                $matrixRow = [];
                for ($j = 0; $j < count($matrixMap[0]); $j++) {
                    if ($j !== $column) {
                        array_push($matrixRow, $matrixMap[$i][$j]);
                    }
                }
                array_push($newMatrixMap, $matrixRow);
            }
        }
        return $newMatrixMap;
    }

    public function transpose() : Matrix
    {
        $transpondedMatrix = [];
        for ($i = 0; $i < $this->countRows(); $i++) {
            for ($j = 0; $j < $this->countColumns(); $j++) {
                $transpondedMatrix[$j][$i] = $this->matrixMap[$i][$j];
            }
        }
        return new Matrix($transpondedMatrix);
    }

    public function matrixOfMinors(array $matrixMap = []) : Matrix
    {
        if (empty($matrixMap)) {
            $matrixMap = $this->matrixMap;
        }
        $rows = count($matrixMap);
        $columns = count($matrixMap[0]);
        $newMatrixMap = [];
        for ($i=0; $i< $rows; $i++) {
            for ($j = 0; $j< $columns; $j++) {
                $subMatrixMap = $this->getSubMatrixMap($matrixMap, $j, $i);
                $determinant = $this->getDeterminant($subMatrixMap);
                $newMatrixMap[$i][$j] = $determinant;
            }
        }
        return new Matrix($newMatrixMap);
    }

    public function matrixOfCoFactors() : Matrix
    {
        $symbol = 1;
        for ($i=0; $i<$this->rows; $i++) {
            for ($j = 0; $j<$this->columns; $j++) {
                $newMatrixMap[$i][$j] = $this->matrixMap[$i][$j] * $symbol;
                $symbol *= -1;
            }
            if (($this->rows % 2) === 0) {
                $symbol *= -1;
            }
        }
        return new Matrix($newMatrixMap);
    }
}
