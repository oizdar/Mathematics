<?php
namespace Math\Tests;

require('../Algebra/Point.php');
require('../Algebra/MultiDimensionalPoint.php');
use \Math\Algebra\Point;
use \Math\Algebra\MultiDimensionalPoint;

class PointsTest extends \PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        $point = new Point(1, 2);
        $this->assertInstanceOf(Point::class, $point);
        $this->assertEquals([1, 2], $point->getCoordinates());

    }

    public function testMultiDimensionalCreate()
    {
        $point3D = new MultiDimensionalPoint([1, 2, 3]);
        $point4D = new MultiDimensionalPoint([1, 2, 3, 4]);
        $point10D = new MultiDimensionalPoint([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertInstanceOf(MultiDimensionalPoint::class, $point3D);
         $this->assertEquals([1, 2, 3], $point3D->getCoordinates());
         $this->assertEquals(3, $point3D->hasDimension());
        $this->assertInstanceOf(MultiDimensionalPoint::class, $point4D);
         $this->assertEquals([1, 2, 3, 4], $point4D->getCoordinates());
         $this->assertEquals(4, $point4D->hasDimension());
        $this->assertInstanceOf(MultiDimensionalPoint::class, $point10D);
         $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $point10D->getCoordinates());
         $this->assertEquals(10, $point10D->hasDimension());
    }

    public function testDistance()
    {
        $point = new Point(3, 2);
        $point2 = new Point(9, 7);
        $this->assertEquals(7.8102496759, $point->distance($point2, 10));

        $point = new Point(-3, 5);
        $point2 = new Point(7, -1);
        $this->assertEquals(11.66, $point->distance($point2, 2));
    }

    public function testMultiDimensionalDistance()
    {
        $point = new MultiDimensionalPoint([9, 2, 7]);
        $point2 = new MultiDimensionalPoint([4, 8, 10]);
        $this->assertEquals(8.37, $point->distance($point2, 2));

        $point = new MultiDimensionalPoint([-1, -1, -1]);
        $point2 = new MultiDimensionalPoint([2, 2, 2]);
        $this->assertEquals(5.19615, $point->distance($point2, 5));

        $point = new MultiDimensionalPoint([6, 51, 3]);
        $point2 = new MultiDimensionalPoint([1.9, 99, 2.9]);
        $this->assertEquals(48.17, $point->distance($point2, 2));

        $point = new MultiDimensionalPoint([0.693, -1.501, -0.201]);
        $point2 = new MultiDimensionalPoint([-1.222, 1.573, -0.557]);
        $this->assertEquals(3.639, $point->distance($point2, 3));
    }
}
