<?php
namespace Math\Algebra;

class MultiDimensionalPoint
{
    /**
     * Coordinates
     * @var array
     */
    private $coordinates;

    /**
     * Dimensions
     * @var  int
     */
    private $dimension;


    public function __construct(array $coordinates)
    {
        $this->coordinates = $coordinates;
        $this->dimension = count($coordinates);
    }

    public function getCoordinates()
    {
        return $this->coordinates;
    }

    public function hasDimension()
    {
        return $this->dimension;
    }

    public function distance(MultiDimensionalPoint $point, int $round = 5) : float
    {
        if ($point->hasDimension() === $this->dimension) {
            $coordinates = $point->getCoordinates();
            $result = 0;
            for ($i=0; $i < $this->dimension; $i++) {
                $result += ($this->coordinates[$i]-$coordinates[$i])**2;
            }
            return round(sqrt($result), $round);
        } else {
            throw new Exception('Points must be the same dimension');
        }
    }
}
