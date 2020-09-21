<?php

namespace Infrastructure\Services;

use Laminas\InputFilter\Factory;

/**
 * Class Validator
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class Validator
{
    /**
     * Validates the given array of data
     *
     * @param array $validationRules
     * @param array $data
     *
     * @return array
     */
    public function validate(array $validationRules, array $data): array
    {
        $errors = [];
        $inputFilterFactory = new Factory();
        $inputFilter = $inputFilterFactory->createInputFilter($validationRules);

        $inputFilter->setData($data);

        if (!$inputFilter->isValid()) {
            foreach ($inputFilter->getInvalidInput() as $error) {
                $inputName = $error->getName();

                if (!isset($errors[$inputName])) {
                    $errors[$inputName] = [];
                }

                $errors[$inputName] = array_merge($errors[$inputName], $error->getMessages());
            }
        }

        return $errors;
    }
}
