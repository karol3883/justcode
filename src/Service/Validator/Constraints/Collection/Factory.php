<?php

namespace App\Service\Validator\Constraints\Collection;

//use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class Factory implements FactoryInterface
{

    public const MINIMUM_NAME_CHARS = 3;
    public const MAKSIUMUM_NAME_CHARS = 50;

    /**
     * @param array $fieldsToValid
     * @return Collection
     */
    public function getConstraintsCollection(array $fieldsToValid): Collection
    {
        $fields = $this->getFieldsToValid();

        $data = [];
        foreach($fieldsToValid as $singleField) {
            if (empty($fields[$singleField])) {
                continue;
            }
            $data[$singleField] = $fields[$singleField];
        }

        return new Collection($data);
    }

    /**
     * @return array
     */
    private function getFieldsToValid(): array
    {
        return [
            'email' => [
                new Email(['message' => 'Email jest nieporpawny']),
                new Length(
                    [
                        'min' => static::MINIMUM_NAME_CHARS,
                        'max' => static::MAKSIUMUM_NAME_CHARS,
                        'minMessage' => sprintf("Imię powinno zawierać minimum %s znaki", static::MINIMUM_NAME_CHARS),
                        'maxMessage' => sprintf("Imię powinno zawierać maksimum %s znaków", static::MAKSIUMUM_NAME_CHARS),
                    ]
                ),
            ],
            'name' => [
                new Regex('/^[A-Za-z]+$/i', 'Bład - imie może zawierać tylko litery'),
                new Length(
                    [
                        'min' => static::MINIMUM_NAME_CHARS,
                        'max' => static::MAKSIUMUM_NAME_CHARS,
                        'minMessage' => sprintf("Imię powinno zawierać minimum %s znaki", static::MINIMUM_NAME_CHARS),
                        'maxMessage' => sprintf("Imię powinno zawierać maksimum %s znaków", static::MAKSIUMUM_NAME_CHARS),
                    ]
                )
            ],
            'message' => new Length(['min' => 10, 'max' => 500]),
        ];
    }
}