<?php
/**
 * Created by PhpStorm.
 * User: mantas
 * Date: 18.11.13
 * Time: 20.13
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;


class DateValidator
{
    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $error;

    /**
     * DateValidator constructor.
     * @param string $date
     */
    public function __construct(string $date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function validateDateFormat(): bool {
        $dateConstraint = new Assert\Date();
        $dateConstraint->message = 'Wrong date format';

        $validator = Validation::createValidator();
        $errors = $validator->validate(
            $this->date,
            $dateConstraint
        );

        if (count($errors) !== 0) {
            $this->error = $errors[0]->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function validateDateTime(): bool {
        $today = new \DateTime();

        if(new \DateTime($this->date) <= $today) {
            $this->error = 'Date must be in the future';
            return false;
        }

        return true;
    }

}