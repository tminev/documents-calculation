<?php

use Domain\ContactList\ContactList;
use Domain\User\User;
use League\FactoryMuffin\Faker\Facade as Faker;

$fm->define(ContactList::class)->setDefinitions([
    'name' => Faker::name(),
    'system' => Faker::numberBetween(1, 2),
    'filters' => Faker::text(),
    'status' => Faker::numberBetween(1, 2),
    'createdTime'  => Faker::dateTime('m-d-Y H:i:s'),
    'modifiedTime'  => Faker::dateTime('m-d-Y H:i:s'),
    'createdByUser' =>  'entity|' . User::class
]);
