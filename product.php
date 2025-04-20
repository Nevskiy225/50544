<?php
session_start();
require_once __DIR__ . "/connection.php";

if (!isset($_GET['id'])) {
    header("Location: catalog");
    exit();
}

$product_id = (int)$_GET['id'];

// Получаем информацию о товаре и его изображениях
$stmt = $conn->prepare("
    SELECT p.*, 
           (SELECT image_url FROM product_images WHERE product_id = p.id AND is_main = 1 LIMIT 1) as main_image
    FROM products p 
    WHERE p.id = ? AND p.is_active = 1
");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: catalog");
    exit();
}

$product = $result->fetch_assoc();

// Получаем все изображения товара
$images_stmt = $conn->prepare("
    SELECT image_url 
    FROM product_images 
    WHERE product_id = ?
    ORDER BY is_main DESC, display_order ASC
");
$images_stmt->bind_param("i", $product_id);
$images_stmt->execute();
$images_result = $images_stmt->get_result();
$product_images = $images_result->fetch_all(MYSQLI_ASSOC);

// Если нет изображений, используем заглушку
if (empty($product_images)) {
    $product_images = [['image_url' => '/images/no-image.jpg']];
    $product['main_image'] = '/images/no-image.jpg';
}

// Обработка добавления в корзину (products.php)
if (isset($_POST['add_to_cart'])) {
    $size = $_POST['size'] ?? '';
    
    if (empty($size)) {
        // Показать ошибку, что размер не выбран
        header("Location: ".$_SERVER['HTTP_REFERER']."?error=size");
        exit();
    }
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Создаем уникальный ключ из ID товара и размера
    $cart_key = $product_id.'_'.$size;
    
    if (isset($_SESSION['cart'][$cart_key])) {
        $_SESSION['cart'][$cart_key]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$cart_key] = [
            'id' => $product_id,
            'name' => $product['name'],
            'price' => $product['price'],
            'old_price' => $product['old_price'] ?? null,
            'image' => $product['main_image'],
            'size' => $size,
            'quantity' => 1
        ];
    }
    
    header("Location: cart");
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
        <?php foreach ($product_images as $index => $image): ?>
            <img src="<?= htmlspecialchars($image['image_url']) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?> <?= $index + 1 ?>" 
                 class="thumbnail <?= $index === 0 ? 'active' : '' ?>"
                 onclick="changeMainImage(this)"
                 data-index="<?= $index ?>">
        <?php endforeach; ?>
    </div>
</div>
            
            <div class="product-info">
                <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                
                <?php if ($product['is_preorder']): ?>
                    <div class="pre-order-label">Предзаказ</div>
              <div class="pre-order-date">Отправки с 8 мая</div>
                <?php endif; ?>
                
                <div class="product-price">
    <?php if (!empty($product['old_price']) && $product['old_price'] > $product['price']): ?>
        <span class="old-price"><?= number_format($product['old_price'], 0, '', ' ') ?> ₽</span>
        <span class="new-price"><?= number_format($product['price'], 0, '', ' ') ?> ₽</span>
        <span class="discount-badge">-<?= round(100 - ($product['price'] / $product['old_price'] * 100)) ?>%</span>
    <?php else: ?>
        <span class="current-price"><?= number_format($product['price'], 0, '', ' ') ?> ₽</span>
    <?php endif; ?>
</div>
                <div class="product-description">
    <?php if (!empty($product['description_of_materials'])): ?>
        <div class="materials-description">
            <strong><?= nl2br(htmlspecialchars($product['description_of_materials'])) ?></strong>
        </div>
        <div class="description-separator"></div>
    <?php endif; ?>
    <?= nl2br(htmlspecialchars($product['description'] ?? 'Описание товара')) ?>
</div>
            
                
                <form method="POST" class="product-form">
                    <div class="size-selector">
    <h3>Размер *<span class="size-help" onclick="showSizeGuide()">?</span></h3>
    <div class="size-options">
        <?php 
        $sizes = explode(',', $product['sizes'] ?? 'S,M,L,XL');
        foreach ($sizes as $size): 
            $size = trim($size);
        ?>
            <div class="size-option <?= isset($_POST['size']) && $_POST['size'] == $size ? 'selected' : '' ?>" 
                 onclick="selectSize(this, '<?= $size ?>')"
                 data-size="<?= $size ?>">
                <?= $size ?>
            </div>
        <?php endforeach; ?>
    </div>
    <input type="hidden" name="size" id="selectedSize" required>
    <div class="error-message" id="sizeError" style="color: red; display: none;">Пожалуйста, выберите размер</div>
</div>
                    
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                        Добавить в корзину
                    </button>
                </form>
            </div>
        </div>
    </main>
    <div id="sizeGuideModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSizeGuide()">&times;</span>
        <img src="/images/size.png" alt="Таблица размеров" class="size-guide-img">
    </div>
</div>
    <?php require_once __DIR__ . "/includes/footer.php"; ?>
    
    <script>
    function selectSize(element, size) {
        document.querySelectorAll('.size-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        element.classList.add('selected');
        document.getElementById('selectedSize').value = size;
        document.getElementById('sizeError').style.display = 'none';
    }
    
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!document.getElementById('selectedSize').value) {
            e.preventDefault();
            document.getElementById('sizeError').style.display = 'block';
        }
    });
        const images = <?= json_encode(array_column($product_images, 'image_url')) ?>;
    let currentImageIndex = 0;
    
    function changeMainImage(thumb) {
        const mainImg = document.getElementById('mainProductImage');
        mainImg.src = thumb.src;
        currentImageIndex = parseInt(thumb.dataset.index);
        
        // Обновляем активную миниатюру
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }
    
    // Обработчики свайпов для мобильных устройств
    let touchStartX = 0;
    let touchEndX = 0;
    
    document.getElementById('mainProductImage').addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, false);
    
    document.getElementById('mainProductImage').addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, false);
    
    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            // Свайп влево - следующее изображение
            currentImageIndex = (currentImageIndex + 1) % images.length;
            updateMainImage();
        }
        if (touchEndX > touchStartX + 50) {
            // Свайп вправо - предыдущее изображение
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            updateMainImage();
        }
    }
    
    function updateMainImage() {
        const mainImg = document.getElementById('mainProductImage');
        mainImg.src = images[currentImageIndex];
        
        // Обновляем активную миниатюру
        document.querySelectorAll('.thumbnail').forEach((t, i) => {
            t.classList.toggle('active', i === currentImageIndex);
        });
    }
    // Добавьте эти функции в существующий тег <script>
function showSizeGuide() {
    document.getElementById('sizeGuideModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeSizeGuide() {
    document.getElementById('sizeGuideModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Закрытие при клике вне изображения
window.onclick = function(event) {
    if (event.target == document.getElementById('sizeGuideModal')) {
        closeSizeGuide();
    }
}

// Закрытие по ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeSizeGuide();
    }
});
</script>
</body>
</html>