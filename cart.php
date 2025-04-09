<!DOCTYPE html>
<html lang="ru">
<?php
// Начинаем сессию

// Подключение к базе данных
require_once __DIR__ . "/connection.php";
$head_path = __DIR__ . "/includes/head.php";

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $full_name = $_POST['full_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $delivery_method = $_POST['delivery_method'] ?? '';
    
    // Валидация данных
    $errors = [];
    
    if (empty($full_name)) {
        $errors[] = "ФИО обязательно для заполнения";
    }
    
    if (empty($phone)) {
        $errors[] = "Телефон обязателен для заполнения";
    } elseif (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
        $errors[] = "Неверный формат телефона";
    }
    
    if (empty($email)) {
        $errors[] = "Email обязателен для заполнения";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email";
    }
    
    if (empty($delivery_method)) {
        $errors[] = "Выберите способ доставки";
    }
    
    // Если ошибок нет, сохраняем заказ
    if (empty($errors)) {
        // Получаем данные корзины
        $cart_items = $_SESSION['cart'] ?? [];
        $order_details = json_encode($cart_items);
        
        // Подготовка SQL-запроса
        $stmt = $conn->prepare("INSERT INTO orders (full_name, phone, email, delivery_method, order_details) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $phone, $email, $delivery_method, $order_details);
        
        if ($stmt->execute()) {
            // Очищаем корзину после успешного оформления
            unset($_SESSION['cart']);
            $success_message = "Заказ успешно оформлен! Номер вашего заказа: " . $stmt->insert_id;
        } else {
            $errors[] = "Ошибка при сохранении заказа: " . $conn->error;
        }
        
        $stmt->close();
    }
}
?>

<head>
    <title>Оформление заказа</title>
    <?php require_once $head_path; ?>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .order-title {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .form-section, .cart-section {
            padding: 20px;
            border-radius: 8px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
        }
        .form-section h3, .cart-section h3 {
            color: #495057;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        .form-control {
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background-color: #0069d9;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid rgba(0, 0, 0, 0.125);
            margin-bottom: 5px;
        }
        .badge-primary {
            background-color: #007bff;
            padding: 8px 12px;
            border-radius: 20px;
        }
        .total-price {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            margin-top: 15px;
        }
        .alert {
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .empty-cart {
            text-align: center;
            color: #6c757d;
            padding: 20px;
        }
        .delivery-options {
            margin-bottom: 20px;
        }
        .delivery-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .delivery-option input {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <?php require_once __DIR__ . "/includes/header.php"; ?>
    
    <div class="container order-container">
        <h1 class="order-title">Оформление заказа</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0;">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success_message) ?>
            </div>
        <?php else: ?>
            <form method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-section">
                            <h3>Контактные данные</h3>
                            
                            <div class="form-group">
                                <label for="full_name">ФИО *</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required 
                                       value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Телефон *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required 
                                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required 
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="form-section">
    <h3>Способ доставки *</h3>
    <div class="delivery-options">
        <?php
        $delivery_methods = [
            'СДЭК' => 'СДЭК (доставка курьером)',
            'Почта России' => 'Почта России',
            'Самовывоз' => 'Самовывоз из нашего магазина'
        ];
        
        foreach ($delivery_methods as $value => $label) {
            $checked = (isset($_POST['delivery_method']) && $_POST['delivery_method'] === $value) ? 'checked="checked"' : '';
            $required = ($value === 'СДЭК') ? 'required="required"' : '';
            
            echo '<div class="delivery-option">
                <input type="radio" id="delivery_'.preg_replace('/\s+/', '_', $value).'" 
                       name="delivery_method" 
                       value="'.htmlspecialchars($value).'"
                       '.$required.' '.$checked.'>
                <label for="delivery_'.preg_replace('/\s+/', '_', $value).'">
                    '.htmlspecialchars($label).'
                </label>
            </div>';
        }
        ?>
    </div>
</div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="cart-section">
                            <h3>Ваш заказ</h3>
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <ul class="list-group">
                                    <?php 
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $item): 
                                        $total += $item['price'] * $item['quantity'];
                                    ?>
                                        <li class="list-group-item">
                                            <span><?= htmlspecialchars($item['name']) ?></span>
                                            <span class="badge badge-primary">
                                                <?= $item['quantity'] ?> × <?= number_format($item['price'], 2) ?> ₽
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="total-price">
                                    Итого: <?= number_format($total, 2) ?> ₽
                                </div>
                                <button type="submit" class="btn btn-primary">Подтвердить заказ</button>
                            <?php else: ?>
                                <div class="empty-cart">
                                    <p>Ваша корзина пуста</p>
                                    <a href="/catalog.php" class="btn btn-outline-primary">Перейти в каталог</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
    
    <?php require_once __DIR__ . "/includes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            // Маска для телефона
            $('#phone').inputmask('+9 (999) 999-99-99');
        });
    </script>
</body>
</html>