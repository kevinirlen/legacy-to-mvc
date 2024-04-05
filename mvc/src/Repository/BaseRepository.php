<?php

namespace App\Repository;


use App\Manager\DBManager;

class BaseRepository
{
    protected $manager;

    /**
     * BaseRepository constructor.
     * @param DBManager $manager
     */
    public function __construct(DBManager $manager)
    {
        $this->manager = $manager;
    }
}