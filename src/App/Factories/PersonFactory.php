<?php

namespace App\Factories;

use App\Helpers\PatternHelper;
use App\Models\Person;

/**
 * Class PersonFactory
 *
 * @package App\Factories
 */
class PersonFactory
{
    /**
     * Creates a person object from a given string (current situation)
     * Ideally, this factory would support other implementations instead of just taking a string
     * and creating an object from it, but that would go outside of the scope for this small task
     *
     * @param string $data
     *
     * @return Person
     */
    public function createPerson(string $data)
    {
        $person = new Person();

        $personInput = explode(" ", trim($data));

        switch (count($personInput)) {
            case 1:
                $person->setTitle($personInput[0]);
                break;
            case 2:
                $person->setTitle($personInput[0]);
                $person->setLastName($personInput[1]);
                break;
            case 3:
                $person->setTitle($personInput[0]);
                if (PatternHelper::isInitial($personInput[1])) {
                    $person->setInitials($personInput[1]);
                } else {
                    $person->setFirstName($personInput[1]);
                }

                $person->setLastName($personInput[2]);
                break;
            case 4:
                $person->setTitle($personInput[0]);
                $person->setFirstName($personInput[1]);
                $person->setLastName($personInput[2]);
                $person->setInitials($personInput[3]);
                break;
        }

        return $person;
    }
}