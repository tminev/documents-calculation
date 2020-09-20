<?php

use Domain\User\User;
use League\FactoryMuffin\Faker\Facade as Faker;

$fm->define(User::class)->setDefinitions([
    'username' => Faker::name(),
    'createdTime'  => Faker::dateTime('m-d-Y H:i:s')
]);
