<?php
namespace Math;

/**
 * Description of Mertens
 *
 * @author Radoslaw
 */

class Operations
{
    /**
     * Mertens Function described e.g.
     * url: http://mathworld.wolfram.com/MertensFunction.html
     * 
     * @return int
     */

    public static function mertensFunction(int $n) : int
    {
        $result = 0;
        for($i = 1; $i <= $n; $i++) {
            $result += static::mobiusFunction($i);
        }
        return $result;
    }

    /**
     * Mobius Function described e.g.
     * url: http://mathworld.wolfram.com/MoebiusFunction.html
     *
     * @return int {1 | 0 | -1} 
     */
    public static function mobiusFunction(int $n) : int
    {
        if($n === 1) {
            return 1;
        } else {
            $array = static::primaryFactors($n);
            $count = static::checkRepeatedFactors($array);
            $arrCount = count($array);
            if ($count === true || $count === false) {
                return (-1)**$arrCount;
            }
            if(is_int($count)) {
                if($count === $arrCount) {
                    return 0;
                } 
                if ($count > 0) {
                    return 0;
                }
            } 
            return 1;
        }
    }

    /**
     * Creates array of primary Factors of given number
     *
     * @return array of integers
     */
    public static function primaryFactors(int $number) : array
    {
        $list = [];
        if($number !== 1) {
            $factor = 2;
            while ($number % $factor !== 0) {
                $factor++; //starts from 2
            }
            $list[] = $factor;
            $list = array_merge(
                $list,
                static::primaryFactors($number/$factor)
            );
        }
        return $list;
    }

    /**
     * Checks are primary factors reapeating.
     * Returns boolean or integer value
     *  @return boolean  true   If it is one primary factor
     *          boolean  false  If there are more than one 
     *                          primary factors
     *          integer         Count of repeated primary factors
     */
    private static function checkRepeatedFactors($array)
    {
        $arrCount = count($array);
        if ($arrCount === 1) {
            return true;
        }
        for ($i = 0; $i < $arrCount; $i++) {
            $count = 0;
            for($j = 0; $j < $arrCount; $j++) {
                if ($i !== $j && $array[$i] === $array[$j]) {
                    $count++;
                }
            }  
            if($count > 0) {
                return $count++;    
            }
        }
        return false;

    }
}
