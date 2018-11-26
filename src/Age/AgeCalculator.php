<?php
/**
 * Created by PhpStorm.
 * User: mantas
 * Date: 18.11.26
 * Time: 11.27
 */

namespace App\Age;


class AgeCalculator
{
    /**
     * @param \DateTime $birthDate
     * @return int
     * @throws \Exception
     */
    public function getAge(\DateTime $birthDate) : int
    {
        $today = new \DateTime('today');

        return $birthDate->diff($today)->y;
    }
}