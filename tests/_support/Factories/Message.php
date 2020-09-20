<?php

use Domain\ContactList\ContactList;
use Domain\Message\Message;
use Domain\User\User;
use League\FactoryMuffin\Faker\Facade as Faker;

$fm->define(Message::class)->setDefinitions([
    'name' => Faker::name(),
    'channel' => Faker::numberBetween(1, 3),
    'content' => Faker::text(),
    'scheduledTime'  => Faker::dateTime('m-d-Y H:i:s'),
    'queuedMessages'  => Faker::numberBetween(1, 300),
    'status' => Faker::numberBetween(1, 4),
    'contactList' => "entity|" . ContactList::class,
    'createdTime'  => Faker::dateTime('m-d-Y H:i:s'),
    'modifiedTime'  => Faker::dateTime('m-d-Y H:i:s'),
    'createdByUser' => "entity|" . User::class
]);
