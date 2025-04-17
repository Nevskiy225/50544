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
        width: 100%;
        display: flex;
        justify-content: center;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 280px)); /* Фиксированная ширина колонок */
        gap: 30px;
        padding: 0 20px;
        width: 100%;
        max-width: 1200px;
        justify-content: center; /* Центрируем колонки сетки */
    }
    
    .product-card {
        padding: 15px;
        width: 280px; /* Фиксированная ширина карточки */
        cursor: pointer;
        transition: transform 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .image-container {
        height: 350px;
        width: 100%;
    }
    
    .product-card h3 {
        font-size: 16px;
        font-weight: 500;
        margin: 10px 0 5px;
        color: #333;
        text-decoration: none;
        text-align: center; /* Центрируем текст */
    }
    
    .product-card p {
        margin-bottom: 15px;
        font-size: 18px;
        font-weight: bold;
        color: #ff6b6b;
        text-decoration: none;
        text-align: center; /* Центрируем текст */
    }
    
    .pre-order-label {
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        font-size: 12px;
    }

    .product-card-link {
        text-decoration: none;
        display: flex;
        justify-content: center;
    }

    /* Медиазапрос для мобильных устройств */
    @media (max-width: 600px) {
        .products-grid {
            grid-template-columns: 280px; /* Одна колонка на мобильных */
            gap: 20px;
            padding: 0 10px;
        }
        
        .center-container {
            padding: 10px 0;
        }
    }
</style>
</head>
<body>
    <?php require_once __DIR__ . "/includes/header.php"; ?>
    
    <div class="center-container">
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
                        </div>
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p><?= number_format($product['price'], 0, '', ' ') ?> ₽</p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php require_once __DIR__ . "/includes/footer.php"; ?>
</body>
</html>