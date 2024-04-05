<?php

namespace App\Manager;

use App\Repository\ProductRepository;

class ProductManager
{
    protected ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findAll(): array
    {
        return $this->productRepository->findAll();
    }

    public function find(int $id)
    {
        return $this->productRepository->find($id);
    }
}