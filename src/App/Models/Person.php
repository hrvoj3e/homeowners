<?php

namespace App\Models;

class Person
{
    private $title;

    private $firstName;

    private $lastName;

    private $initials;

    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setInitials(string $initials)
    {
        $this->initials = $initials;

        return $this;
    }

    public function getInitials()
    {
        return $this->initials;
    }
}