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
    private $error;

    /**
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    private $validator;

    /**
     * DateValidator constructor.
     */
    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    /**
     * @return mixed
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    private function resetError(): void
    {
        $this->error = null;
    }

    /**
     * @param $date
     * @param $dateConstraint
     * @return bool
     */
    private function validateByConstraint($date, $dateConstraint): bool
    {
        $errors = $this->validator->validate($date, $dateConstraint);

        if (count($errors) !== 0) {
            $this->error = $errors[0]->getMessage();
            return false;
        }

        $this->resetError();
        return true;
    }

    /**
     * @param string $date
     * @return bool
     */
    public function validateDateFormat(string $date): bool
    {
        $dateConstraint = new Assert\Date();
        $dateConstraint->message = 'Wrong date format';

        return $this->validateByConstraint($date, $dateConstraint);
    }

    /**
     * @param \DateTime $date
     * @return bool
     */
    public function validateDateTime(\DateTime $date): bool
    {
        $dateConstraint = new Assert\GreaterThanOrEqual('today');
        $dateConstraint->message = 'Date must not be in the past';

        return $this->validateByConstraint($date, $dateConstraint);
    }

}