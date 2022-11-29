<?php

namespace App\Service\Validator\Constraints\Collection;

use Symfony\Component\Validator\Constraints\Collection;

interface FactoryInterface
{
    public function getConstraintsCollection(array $fieldsToValid): Collection;
}