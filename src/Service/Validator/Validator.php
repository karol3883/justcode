<?php

namespace App\Service\Validator;

use App\Service\Validator\Constraints\Collection\FactoryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validation;


class Validator implements ValidatorInterface
{

    public function __construct(
        private readonly FactoryInterface $constraintCollectionFactory,
        private readonly SessionInterface $session
    )
    {

    }

    public function isValid(array $fieldToValid, array $dataToValid): bool
    {
        if (empty($dataToValid)) {
            $this->session->getFlashBag()->add('danger', "Wystapił bład!");
            return false;
        }

        $constraintCollection = $this->constraintCollectionFactory->getConstraintsCollection($fieldToValid);
        $validator = Validation::createValidator();
        $violations = $validator->validate($dataToValid, $constraintCollection);

        if (count($violations) !== 0) {
            foreach($violations as $violation) {
                $this->session->getFlashBag()->add('danger', "{$violation->getMessage()}");
            }

            return false;
        }

        return true;
    }

}