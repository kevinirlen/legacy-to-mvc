<?php

try {
    $pdo = new PDO("mysql:host=docker-mysql;dbname=legacy", 'legacy', 'J"@MM4s2fZc~FB+r');
    $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
} catch (\PDOException $e) {
    throw new \Exception($e->getMessage());
}

function getProducts(\PDO $pdo): array
{
    $result = $pdo->query("SELECT * FROM products");

    $products = [];

    foreach ($result as $index => $product) {
        $products[] = $product;
    }

    return $products;
}

function getProductById(\PDO $pdo, int $id): array
{
    $statement = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $statement->bindParam(':id', $id);

    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    return $statement->fetch();
}
