<?php
/**
 * Created by PhpStorm.
 * User: mantas
 * Date: 18.11.26
 * Time: 11.36
 */

namespace App\Age;


class AgeManager
{
    /**
     * @var int $age
     */
    private $age;

    /**
     * @var AgeCalculator
     */
    private $ageCalculator;

    /**
     * @var AdultChecker $adultChecker
     */
    private $adultChecker;

    /**
     * AgeManager constructor.
     * @param AgeCalculator $ageCalculator
     * @param AdultChecker $adultChecker
     */
    public function __construct(AgeCalculator $ageCalculator, AdultChecker $adultChecker)
    {
        $this->ageCalculator = $ageCalculator;
        $this->adultChecker = $adultChecker;
    }

    /**
     * @param $birthDate
     * @return string
     */
    public function getAgeMessage($birthDate) : string
    {
        try {
            $this->age = $this->ageCalculator->getAge(new \DateTime($birthDate));
            return 'I am '. $this->age . ' years old';
        } catch (\Exception $exp) {
            return 'Wrong date format';
        }
    }

    /**
     * @return string|null
     */
    public function getAdultMessage() : string
    {
        try {
            $isAdult = $this->adultChecker->isAdult($this->age);
            return 'Am I an adult ?  ---- ' . ($isAdult ? 'YES !!' : 'NO !!!');
        } catch (\TypeError $exp) {
            return 'Age is not set';
        }
    }
}