<?php
    include 'includes/header.php';
?>
    <body>
<div class="container mt-5">
    <h1>Products</h1>

    <div class="row">
        <?php
            /** @var \PDO $pdo */
            foreach(getProducts($pdo) as $product):
        ?>
            <div class="col-3">
                <div class="product-card">
                    <img src="<?php echo $product['image'];?>" alt="Product 1">
                    <div class="card-body">
                        <h5>
                            <a href="product.php?id=<?php echo $product['id'];?>" class="product-link"><?php echo $product['title'];?></a>
                        </h5>
                        <p><?php echo $product['description'];?></p>
                        <p>Price: Rs <?php echo number_format($product['price'], '2', '.', ',' );?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>