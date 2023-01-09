<?php

namespace App\Service\Validator;

interface ValidatorInterface
{
    public function isValid(array $fieldToValid, array $dataToValid): bool;
}