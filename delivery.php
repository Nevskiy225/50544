<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Условия доставки | 50541</title>
    <?php
    require_once __DIR__ . "/connection.php";
    $header_path = __DIR__ . "/includes/header.php";
    $footer_path = __DIR__ . "/includes/footer.php";
    $head_path = __DIR__ . "/includes/head.php";
    
    require_once $head_path;
    ?>
    <link rel="stylesheet" href="/css/delivery.css">
</head>
<body>
    <?php
    require_once $header_path;
    ?>
    
    <main class="delivery-section">
        <h1 class="delivery-title">Условия доставки</h1>
        
        <div class="delivery-frame">
            <span class="delivery-update">Последнее обновление: <?php echo date('d.m.Y'); ?></span>
            
            <div class="delivery-content">
                <h2>1. Способы доставки</h2>
                <p>1.1. Мы предлагаем несколько вариантов доставки для вашего удобства:</p>
                <ul>
                    <li><strong>Службы доставки СДЭК</strong> — быстрая доставка по России.</li>
                </ul>
                
                <h2>2. Сроки доставки</h2>
                <p>2.1. Сроки зависят от выбранного товара:</p>
                <ul>
                    <li>СДЭК 2-7 дней.</li>
                </ul>
                <p>2.2. Точные сроки уточняются после оформления заказа.</p>
                
                <h2>3. Стоимость доставки</h2>
                <p>3.1. СДЭК: стоимость зависит от веса и расстояния.</p>
                
                <h2>4. Отслеживание заказа</h2>
                <p>4.1. После отправки заказа мы вышлем вам трек-номер для отслеживания.</p>
                <p>4.2. Вы можете отслеживать статус заказа в личном кабинете.</p>
                
                <h2>5. Возврат и обмен</h2>
                <p>5.1. Возврат товара возможен в течение 14 дней с момента получения.</p>
                <p>5.2. Товар должен сохранить товарный вид и упаковку.</p>
                <p>5.3. Стоимость доставки при возврате не компенсируется.</p>
                
                <div class="contact-info">
                    <h3>Контакты</h3>
                    <p>
                        <i class="fas fa-envelope"></i>Gmail: 
                        <a href="mailto:50541sup@gmail.com" title="Написать на 50541sup@gmail.com">50541sup@gmail.com</a>
                    </p>
                    <p><i class="fas fa-phone"></i> Телефон: +7 (904) 921-45-68</p>
                </div>
            </div>
        </div>
    </main>
    
    <?php
    require_once $footer_path;
    ?>
</body>
</html>