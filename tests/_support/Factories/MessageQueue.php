<?php

use Domain\Message\Message;
use Domain\MessageQueue\MessageQueue;
use Domain\User\User;
use League\FactoryMuffin\Faker\Facade as Faker;

$fm->define(MessageQueue::class)->setDefinitions([
    'contactId' => Faker::numberBetween(1, 100),
    'contactName' => Faker::name(),
    'contactPhone' => Faker::phoneNumber(),
    'contactEmail' => Faker::email(),
    'content' => Faker::text(),
    'status' => Faker::numberBetween(1, 3),
    'message' =>  'entity|' . Message::class,
    'createdTime'  => Faker::dateTime('m-d-Y H:i:s'),
    'modifiedTime'  => Faker::dateTime('m-d-Y H:i:s'),
    'createdByUser' =>  'entity|' . User::class
]);
