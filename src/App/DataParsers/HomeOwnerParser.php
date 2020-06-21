<?php

namespace App\DataParsers;

use App\Factories\PersonFactory;
use App\Helpers\PatternHelper;
use App\Models\Person;

/**
 * Specific implementation for parsing home owners
 *
 * Class HomeOwnerParser
 *
 * @package App\DataParsers
 */
class HomeOwnerParser implements DataParserInterface
{
    protected const PERSON_SEPARATOR = ['&', 'and'];
    protected $data;

    /**
     * @var PersonFactory
     */
    private $personFactory;

    /**
     * HomeOwnerParser constructor.
     *
     * @param PersonFactory $personFactory
     */
    public function __construct(PersonFactory $personFactory)
    {
        $this->personFactory = $personFactory;
    }

    /**
     * Data set given for this type of parser
     *
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * This will loop through the given set of data at first, and if there is more than one person in a row,
     * it will copy the missing data from people that are missing it
     *
     * @return array
     */
    public function parse()
    {
        $personList = [];

        foreach ($this->data as $row) {
            if ($row == 'homeowner') {
                continue;
            }
            // check if there is more people in a row
            $peopleSeparator = PatternHelper::isMultiple($row, self::PERSON_SEPARATOR);

            if ($peopleSeparator) {
                $people = explode($peopleSeparator, $row);

                foreach ($people as $person) {
                    $personList[] = $this->personFactory->createPerson($person);
                }
            } else {
                $personList[] = $this->personFactory->createPerson($row);
            }
        }

        // loop through the list and copy missing data from "right to left"
        $peopleCount = count($personList);

        for ($i = 0; $i < $peopleCount; $i++) {
            if (!$this->isValidObject($personList[$i])) {
                $next          = $i + 1;
                $currentPerson = $personList[$i];
                $nextPerson    = $personList[$next];

                if ($next < $peopleCount) {
                    if ($personList[$next]->getFirstName()) {
                        $currentPerson->setFirstName($nextPerson->getFirstName());
                    }

                    if ($personList[$next]->getInitials()) {
                        $currentPerson->setInitials($nextPerson->getInitials());
                    }

                    $currentPerson->setLastName($nextPerson->getLastName());
                    $nextPerson->setFirstName("");
                    $nextPerson->setInitials("");
                }
            }
        }

        return $personList;
    }

    /**
     * Check if a person has all needed attributes.
     * It's a simple check and I didn't go to deep into this
     *
     * @param Person $person
     *
     * @return bool
     */
    private function isValidObject(Person $person)
    {
        return $person->getLastName() != "";
    }
}
