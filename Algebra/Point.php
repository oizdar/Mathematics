<?php
namespace Math\Algebra;

class Point
{
    /**
     * Coordinates
     * @var float
     */
    private $x;
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getCoordinates()
    {
        return [$this->x, $this->y];
    }

    public function distance(Point $point, int $round = 5) : float
    {
        $coordinates = $point->getCoordinates();
        return round(sqrt(($this->x - $coordinates[0])**2 + ($this->y - $coordinates[1])**2), $round);
    }
}
