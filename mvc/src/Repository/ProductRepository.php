<?php

namespace App\Repository;

use App\Manager\DBManager;

class ProductRepository extends BaseRepository
{
    public function findAll(): array
    {
        $query = 'SELECT * FROM products';

        return $this->manager->findAll($query);
    }

    public function find($id): array
    {
        $query = 'SELECT * FROM products WHERE id = :id';

        return $this->manager->find($query, [
            ':id' => $id,
        ]);
    }
}