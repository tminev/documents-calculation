<?php

use League\FactoryMuffin\Faker\Facade as Faker;
use Stubs\EntityStub;

$fm->define(EntityStub::class)->setDefinitions([
    'property' => Faker::name(),
]);
