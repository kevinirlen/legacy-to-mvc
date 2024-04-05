<?php include 'includes/header.php'; ?>

<?php
/** @var \PDO $pdo */
$product = getProductById($pdo, (int)$_GET['id']);
?>

<div class="container">
    <div class="product-details">
        <img src="<?php echo $product['image'];?>"  alt="<?php echo $product['title'];?>" />
        <h2><?php echo $product['title'];?></h2>
        <p><?php echo $product['description'];?></p>
        <p>Price: Rs <?php echo number_format($product['price'], '2', '.', ',' );?></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>