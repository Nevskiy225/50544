<?php
session_start();
require_once __DIR__ . "/connection.php";

// Обработка удаления товара
if (isset($_GET['remove_item'])) {
    $product_id = (int)$_GET['remove_item'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    header("Location: cart.php");
    exit();
}

// Обработка оформления заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $required_fields = ['full_name', 'phone', 'email', 'delivery_method'];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Поле " . ucfirst(str_replace('_', ' ', $field)) . " обязательно для заполнения";
        }
    }
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email";
    }
    
    if (!preg_match('/^\+?[0-9]{10,15}$/', $_POST['phone'])) {
        $errors[] = "Неверный формат телефона";
    }
      if (empty($errors) && !empty($_SESSION['cart'])) {
        // Получаем названия товаров из базы данных
        $product_ids = array_keys($_SESSION['cart']);
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
        $stmt = $conn->prepare("SELECT id, name FROM products WHERE id IN ($placeholders)");
        $stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[$row['id']] = $row['name'];
        }
        
        // Создаем списки товаров и количеств
        $product_names = [];
        $quantities = [];
        $total_quantity = 0;
        
        foreach ($_SESSION['cart'] as $id => $item) {
            $product_names[] = $products[$id] ?? 'Неизвестный товар';
            $quantities[] = $item['quantity'];
            $total_quantity += $item['quantity'];
        }
        
        // Объединяем названия товаров через запятую
        $product_name = implode(', ', $product_names);
        
        $order_details = json_encode([
            'items' => $_SESSION['cart'],
            'total' => array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $_SESSION['cart']))
        ], JSON_UNESCAPED_UNICODE);
        
        // Вставляем заказ с учетом количества товаров
        $stmt = $conn->prepare("INSERT INTO orders (full_name, phone, email, delivery_method, product_name, quantity, order_details) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", 
            $_POST['full_name'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['delivery_method'],
            $product_name,
            $total_quantity,
            $order_details
        );
        
        if ($stmt->execute()) {
            unset($_SESSION['cart']);
            $success_message = "Заказ успешно оформлен!";
        } else {
            $errors[] = "Ошибка при сохранении заказа: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<?php
$head_path = __DIR__ . "/includes/head.php";
$header_path = __DIR__ . "/includes/header.php";
$footer_path = __DIR__ . "/includes/footer.php";
?>
<head>
    <title>Корзина | 50541</title>
    <?php require_once $head_path; ?>
    <link rel="stylesheet" href="/css/stylecart.css">
</head>
<body>
    <?php require_once $header_path; ?>
    
    <main class="cart-container">
        <h1>Корзина</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success_message) ?>
                <p><a href="/catalog.php" class="btn btn-outline-primary">Вернуться в каталог</a></p>
            </div>
        <?php else: ?>
            <form method="POST">
                <div class="cart-content">
                    <div class="cart-form">
                        <h3>Контактные данные</h3>
                        <div class="form-group">
                            <label>ФИО *</label>
                            <input type="text" name="full_name" class="form-control" required 
                                   value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Телефон *</label>
                            <input type="tel" name="phone" class="form-control" required 
                                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required 
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        
                        <h3>Способ доставки *</h3>
                        <div class="delivery-options">
                            <div class="delivery-option">
                                <input type="radio" id="delivery_cdek" name="delivery_method" value="СДЭК" required>
                                <label for="delivery_cdek">СДЭК (доставка курьером)</label>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="cart-items">
                        <h3>Ваш заказ</h3>
                        <?php if (!empty($_SESSION['cart'])): ?>
                            <?php 
                            $total = 0;
                            foreach ($_SESSION['cart'] as $id => $item): 
                                $total += $item['price'] * $item['quantity'];
                            ?>
                                <div class="cart-item">
                                    <div class="cart-item-info">
                                        <img src="<?= htmlspecialchars($item['image']) ?>" 
                                             alt="<?= htmlspecialchars($item['name']) ?>" 
                                             class="cart-item-image">
                                        <div class="cart-item-name"><?= htmlspecialchars($item['name']) ?></div>
                                    </div>
                                    <div class="cart-item-details">
                                        <div class="cart-item-price"><?= number_format($item['price'], 0, '', ' ') ?> ₽</div>
                                        <div class="cart-item-quantity">× <?= $item['quantity'] ?></div>
                                        <button type="button" onclick="if(confirm('Удалить товар из корзины?')) window.location.href='?remove_item=<?= $id ?>'" 
                                                class="remove-item">Удалить</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="total-price">
                                Итого: <?= number_format($total, 0, '', ' ') ?> ₽
                            </div>
                            <button type="submit" class="btn">Оформить заказ</button>
                        <?php else: ?>
                            <div class="empty-cart">
                                <p>Ваша корзина пуста</p>
                                <a href="/catalog.php" class="btn btn-outline-primary">Перейти в каталог</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </main>
    
    <?php require_once $footer_path; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="phone"]').inputmask("+9 (999) 999-99-99");
        });
    </script>
</body>
</html>
