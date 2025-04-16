<?php
session_start();
require_once __DIR__ . "/connection.php";

// Проверяем, передан ли ID товара
if (!isset($_GET['id'])) {
    header("Location: catalog.php");
    exit();
}

$product_id = (int)$_GET['id'];

// Получаем информацию о товаре
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ? AND is_active = 1");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: catalog.php");
    exit();
}

$product = $result->fetch_assoc();

// Обработка добавления в корзину
if (isset($_POST['add_to_cart'])) {
    $size = $_POST['size'] ?? '';
    
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
            'size' => $size,
            'quantity' => 1
        ];
    }
    
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= htmlspecialchars($product['name']) ?> | 50541</title>
    <?php require_once __DIR__ . "/includes/head.php"; ?>
    <link rel="stylesheet" href="/css/product.css">
</head>
<body>
    <?php require_once __DIR__ . "/includes/header.php"; ?>
    
    <main class="product-container">
        <div class="product-content">
            <div class="product-images">
                <div class="main-image-container">
                    <img src="<?= htmlspecialchars($product['main_image']) ?>" 
                         alt="<?= htmlspecialchars($product['name']) ?>" 
                         class="main-image"
                         id="mainProductImage">
                </div>
                
                <div class="thumbnail-container">
                    <img src="<?= htmlspecialchars($product['main_image']) ?>" 
                         alt="<?= htmlspecialchars($product['name']) ?>" 
                         class="thumbnail active"
                         onclick="changeMainImage(this)">
                    
                    <?php if (!empty($product['hover_image'])): ?>
                        <img src="<?= htmlspecialchars($product['hover_image']) ?>" 
                             alt="<?= htmlspecialchars($product['name']) ?> другой ракурс" 
                             class="thumbnail"
                             onclick="changeMainImage(this)">
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="product-info">
                <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                
                <?php if ($product['is_preorder']): ?>
                    <div class="pre-order-label">Предзаказ</div>
                <?php endif; ?>
                
                <div class="product-price"><?= number_format($product['price'], 0, '', ' ') ?> ₽</div>
                
                <div class="product-description">
                    <?= nl2br(htmlspecialchars($product['description'] ?? 'Описание товара')) ?>
                </div>
                
                <form method="POST" class="product-form">
                    <div class="size-selector">
                        <h3>Размер</h3>
                        <div class="size-options">
                            <?php 
                            $sizes = explode(',', $product['sizes'] ?? 'S,M,L,XL');
                            foreach ($sizes as $size): 
                                $size = trim($size);
                            ?>
                                <div class="size-option" 
                                     onclick="selectSize(this, '<?= $size ?>')"
                                     data-size="<?= $size ?>">
                                    <?= $size ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="size" id="selectedSize" required>
                    </div>
                    
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                        Добавить в корзину
                    </button>
                </form>
            </div>
        </div>
    </main>
    
    <?php require_once __DIR__ . "/includes/footer.php"; ?>
    
    <script>
        function changeMainImage(thumbnail) {
            document.querySelectorAll('.thumbnail').forEach(img => {
                img.classList.remove('active');
            });
            
            thumbnail.classList.add('active');
            document.getElementById('mainProductImage').src = thumbnail.src;
        }
        
        function selectSize(element, size) {
            document.querySelectorAll('.size-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            element.classList.add('selected');
            document.getElementById('selectedSize').value = size;
        }
    </script>
</body>
</html>