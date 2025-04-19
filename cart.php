<?php
session_start();
require_once __DIR__ . "/connection.php";

// Обработка удаления товара
if (isset($_GET['remove_item'])) {
    $cart_key = $_GET['remove_item'];
    if (isset($_SESSION['cart'][$cart_key])) {
        unset($_SESSION['cart'][$cart_key]);
    }
    header("Location: cart.php");
    exit();
}

// Обработка изменения количества
if (isset($_GET['update_quantity'])) {
    $cart_key = $_GET['cart_key'];
    $quantity = (int)$_GET['quantity'];
    
    if (isset($_SESSION['cart'][$cart_key]) && $quantity > 0) {
        $_SESSION['cart'][$cart_key]['quantity'] = $quantity;
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
    
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    if (strlen($phone) === 11 && in_array($phone[0], ['7', '8'])) {
        $_POST['phone'] = '+7' . substr($phone, 1);
    } elseif (strlen($phone) === 10) {
        $_POST['phone'] = '+7' . $phone;
    } else {
        $errors[] = "Телефон должен содержать 11 цифр";
    }
    
    if (empty($errors) && !empty($_SESSION['cart'])) {
        $product_ids = array_map(function($key) {
            return explode('_', $key)[0];
        }, array_keys($_SESSION['cart']));
        
        $product_ids = array_unique($product_ids);
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
        $stmt = $conn->prepare("SELECT id, name FROM products WHERE id IN ($placeholders)");
        
        if (count($product_ids) > 0) {
            $types = str_repeat('i', count($product_ids));
            $stmt->bind_param($types, ...$product_ids);
            $stmt->execute();
            $result = $stmt->get_result();
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[$row['id']] = $row['name'];
            }
        }
        
        $product_names = [];
        $quantities = [];
        $sizes = [];
        $total_quantity = 0;
        
        foreach ($_SESSION['cart'] as $item) {
            $product_name = ($products[$item['id']] ?? 'Неизвестный товар') . ' (Размер: ' . $item['size'] . ') × ' . $item['quantity'];
            $product_names[] = $product_name;
            $quantities[] = $item['quantity'];
            $sizes[] = $item['size'];
            $total_quantity += $item['quantity'];
        }
        
        $product_name = implode(', ', $product_names);
        $size_string = '';
        foreach ($_SESSION['cart'] as $item) {
            $size_string .= str_repeat($item['size'] . ', ', $item['quantity']);
        }
        $size_string = rtrim($size_string, ', ');
        
        $order_details = json_encode([
            'items' => $_SESSION['cart'],
            'total' => array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $_SESSION['cart']))
        ], JSON_UNESCAPED_UNICODE);
        
        $stmt = $conn->prepare("INSERT INTO orders (full_name, phone, email, delivery_method, product_name, size, quantity, order_details) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssis", 
            $_POST['full_name'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['delivery_method'],
            $product_name,
            $size_string,
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
                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                   placeholder="+7 (___) ___-__-__">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required 
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        
                        <h3>Доставка</h3>
                        <div class="delivery-options">
                            <p>Доставка через СДЭК</p>
                            <input type="hidden" name="delivery_method" value="СДЭК">
                        </div>
                    </div>
                    
                    <div class="cart-items">
                        <h3>Ваш заказ</h3>
                        <?php if (!empty($_SESSION['cart'])): ?>
                            <?php 
                            $total = 0;
                            foreach ($_SESSION['cart'] as $cart_key => $item): 
                                $total += $item['price'] * $item['quantity'];
                            ?>
                                <div class="cart-item">
                                    <div class="cart-item-info">
                                        <img src="<?= htmlspecialchars($item['image']) ?>" 
                                             alt="<?= htmlspecialchars($item['name']) ?>" 
                                             class="cart-item-image">
                                        <div class="cart-item-meta">
                                            <div class="cart-item-name"><?= htmlspecialchars($item['name']) ?></div>
                                            <div class="cart-item-size">Размер: <?= htmlspecialchars($item['size']) ?></div>
                                            <div class="quantity-control">
                                                <a href="?update_quantity=1&cart_key=<?= $cart_key ?>&quantity=<?= $item['quantity'] - 1 ?>" class="quantity-btn">-</a>
                                                <span class="quantity-value"><?= $item['quantity'] ?></span>
                                                <a href="?update_quantity=1&cart_key=<?= $cart_key ?>&quantity=<?= $item['quantity'] + 1 ?>" class="quantity-btn">+</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-item-details">
                                        <div class="price-remove-wrapper">
                                            <div class="price-block">
                                               <?php if (isset($item['old_price']) && $item['old_price'] > $item['price']): ?>
                                                    <div class="discount-badge">-<?= round(100 - ($item['price'] / $item['old_price'] * 100)) ?>%</div>
                                                    <div class="price-line">
                                                        <span class="old-price"><?= number_format($item['old_price'], 0, '', ' ') ?> ₽</span>
                                                        <span class="current-price"><?= number_format($item['price'], 0, '', ' ') ?> ₽</span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="current-price"><?= number_format($item['price'], 0, '', ' ') ?> ₽</div>
                                                <?php endif; ?>
                                            </div>
                                            <button type="button" onclick="if(confirm('Удалить товар из корзины?')) window.location.href='?remove_item=<?= $cart_key ?>'" 
                                                    class="remove-item">Удалить</button>
                                        </div>
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
<script>
    $(document).ready(function() {
        // Ваш оригинальный код форматирования телефона
        $('input[name="phone"]').on('input', function(e) {
            let value = $(this).val().replace(/\D/g, '');
            
            if (value.length > 0) {
                if (value[0] === '8') {
                    value = '7' + value.substring(1);
                } else if (value[0] !== '7') {
                    value = '7' + value;
                }
            }
            
            let formatted = '+7';
            if (value.length > 1) {
                formatted += ' (' + value.substring(1, 4);
            }
            if (value.length > 4) {
                formatted += ') ' + value.substring(4, 7);
            }
            if (value.length > 7) {
                formatted += '-' + value.substring(7, 9);
            }
            if (value.length > 9) {
                formatted += '-' + value.substring(9, 11);
            }
            
            $(this).val(formatted);
            
            const pos = formatted.indexOf('_');
            if (pos >= 0) {
                this.setSelectionRange(pos, pos);
            } else if (formatted.length < 18) {
                this.setSelectionRange(formatted.length, formatted.length);
            } else {
                this.setSelectionRange(18, 18);
            }
        });

        // Защита от удаления +7
        $('input[name="phone"]').on('keydown', function(e) {
            if (this.selectionStart <= 3 && (e.key === 'Backspace' || e.key === 'Delete')) {
                e.preventDefault();
            }
        });

        // Исправленный обработчик для кнопок +/-
        $(document).on('click', '.quantity-btn', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            
            // Показываем индикатор загрузки
            const quantityElement = $(this).siblings('.quantity-value');
            quantityElement.addClass('updating');
            
            // Отправляем GET-запрос
            window.location.href = url;
            
            // Альтернативный вариант с AJAX (если нужно без перезагрузки)
            /*
            $.get(url, function(response) {
                location.reload();
            }).fail(function() {
                alert('Ошибка при обновлении количества');
                quantityElement.removeClass('updating');
            });
            */
        });
    });
</script>
</body>
</html>