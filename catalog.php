<?php
session_start();
require_once __DIR__ . "/connection.php";

// Обработка добавления в корзину
if (isset($_GET['add_to_cart'])) {
    $product_id = (int)$_GET['add_to_cart'];
    
    $stmt = $conn->prepare("SELECT id, name, price, old_price main_image FROM products WHERE id = ? AND is_active = 1");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $product_id,
                'name' => $product['name'],
                'price' => $product['price'],
                'old_price' => $product['old_price'],
                'image' => $product['main_image'],
                'quantity' => 1
            ];
        }
        
        header("Location: cart.php");
        exit();
    }
}

// Получаем товары
$products = [];
$query = "SELECT * FROM products WHERE is_active = 1 AND id != 4";
$result = $conn->query($query);
if ($result) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Каталог одежды | 50541</title>
    <link rel="stylesheet" href="css/catalog.css?v=<?= time() ?>"> <!-- Добавлен параметр версии -->
    <?php require_once __DIR__ . "/includes/head.php"; ?>
</head>
<body>
    <?php require_once __DIR__ . "/includes/header.php"; ?>
    
    <div class="center-container">
        <h1 class="catalog-title">Худи</h1>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <a href="product.php?id=<?= $product['id'] ?>" class="product-card-link">
                    <div class="product-card">
                        <div class="image-container">
                            <img src="<?= htmlspecialchars($product['main_image']) ?>" 
                                 alt="<?= htmlspecialchars($product['name']) ?>" 
                                 class="main-image">
                            <?php if (!empty($product['hover_image'])): ?>
                                <img src="<?= htmlspecialchars($product['hover_image']) ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?> другой ракурс" 
                                     class="hover-image">
                            <?php endif; ?>
                            <?php if ($product['is_preorder']): ?>
                                <div class="pre-order-label">Предзаказ</div>
                            <?php endif; ?>
                            <?php if (!empty($product['old_price']) && $product['old_price'] > $product['price']): ?>
                                <div class="discount-label">-<?= round(100 - ($product['price'] / $product['old_price'] * 100)) ?>%</div>
                            <?php endif; ?>
                        </div>
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <div class="price-container">
                            <?php if (!empty($product['old_price']) && $product['old_price'] > $product['price']): ?>
                                <span class="old-price"><?= number_format($product['old_price'], 0, '', ' ') ?> ₽</span>
                                <span class="new-price"><?= number_format($product['price'], 0, '', ' ') ?> ₽</span>
                            <?php else: ?>
                                <span class="price"><?= number_format($product['price'], 0, '', ' ') ?> ₽</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php require_once __DIR__ . "/includes/footer.php"; ?>
</body>
</html>