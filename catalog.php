<?php
session_start();
require_once __DIR__ . "/connection.php";

// Обработка добавления в корзину
if (isset($_GET['add_to_cart'])) {
    $product_id = (int)$_GET['add_to_cart'];
    
    $stmt = $conn->prepare("SELECT id, name, price, main_image FROM products WHERE id = ? AND is_active = 1");
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
    <?php require_once __DIR__ . "/includes/head.php"; ?>
    <style>
        /* Специфичные стили только для catalog.php */
        .center-container {
            padding: 20px 0;
            margin: 20px 0;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }
        
        .product-card {
            padding: 15px;
            max-width: 300px;
        }

        .image-container {
            height: 350px;
        }
        
        .product-card h3 {
            font-size: 18px;
            margin: 15px 0 10px;
        }
        
        .product-card p {
            margin-bottom: 15px;
        }
        
        .pre-order-label {
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <?php require_once __DIR__ . "/includes/header.php"; ?>
    
    <div class="center-container">
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
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
                    </div>
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= number_format($product['price'], 0, '', ' ') ?> ₽</p>
                    <a href="?add_to_cart=<?= $product['id'] ?>" class="add-to-cart">Оформить предзаказ</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php require_once __DIR__ . "/includes/footer.php"; ?>
</body>
</html>