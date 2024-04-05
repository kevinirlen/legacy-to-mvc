<?php

return [
    'db.name' => 'mvc',
    'db.host' => 'docker-mysql-mvc', // If you are using docker, this value should be 'docker-mysql'
    'db.user' => 'mvc',
    'db.password' => 'J"@MM4s2fZc~FB+r',
    \App\Manager\DBManager::class => \DI\autowire()->constructor(
        \DI\get('db.name'),
        \DI\get('db.host'),
        \DI\get('db.user'),
        \DI\get('db.password')
    )
];