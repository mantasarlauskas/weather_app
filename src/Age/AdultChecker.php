<?php
/**
 * Created by PhpStorm.
 * User: mantas
 * Date: 18.11.26
 * Time: 11.29
 */

namespace App\Age;


class AdultChecker
{
    /**
     * @param int $age
     * @return bool
     */
    public function isAdult(int $age) : bool
    {
        return $age >= 18;
    }

}