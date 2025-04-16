<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Политика использования сайта | 50541</title>
    <?php
    require_once __DIR__ . "/connection.php";
    $header_path = __DIR__ . "/includes/header.php";
    $footer_path = __DIR__ . "/includes/footer.php";
    $head_path = __DIR__ . "/includes/head.php";
    
    require_once $head_path;
    ?>
    <style>
        /* Стили для страницы политики */
        .policy-section {
            padding: 40px 5%;
            margin: 0 auto;
            background-color: transparent;
            max-width: 1200px;
        }
        
        .policy-frame {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .policy-title {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }
        
        .policy-update {
            font-style: italic;
            color: #666;
            margin-bottom: 40px;
            text-align: center;
            display: block;
        }
        
        .policy-content h2 {
            font-size: 1.8rem;
            margin: 40px 0 20px;
            color: #444;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .policy-content h3 {
            font-size: 1.4rem;
            margin: 30px 0 15px;
            color: #444;
        }
        
        .policy-content p {
            margin-bottom: 15px;
            color: #555;
            line-height: 1.6;
        }
        
        .policy-content ul {
            margin-bottom: 20px;
            padding-left: 20px;
        }
        
        .policy-content li {
            margin-bottom: 10px;
        }
        
        .policy-content a {
            color: #ff6b6b;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .policy-content a:hover {
            color: #ff5252;
            text-decoration: underline;
        }
        
        .contact-info {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            .policy-frame {
                padding: 25px;
            }
            
            .policy-title {
                font-size: 2rem;
            }
            
            .policy-content h2 {
                font-size: 1.5rem;
            }
            
            .policy-content h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <?php
    require_once $header_path;
    ?>
    
    <main class="policy-section">
        <h1 class="policy-title">Политика использования сайта 50541</h1>
        
        <div class="policy-frame">
            <span class="policy-update">Последнее обновление: <?php echo date('d.m.Y'); ?></span>
            
            <div class="policy-content">
                <h2>1. Общие положения</h2>
                <p>1.1. Интернет-магазин 50541 (далее — "Магазин") осуществляет продажу одежды и аксессуаров через сайт <a href="https://50541.ru">https://50541.ru</a>.</p>
                <p>1.2. Настоящая Политика определяет правила использования сайта Магазина и оформления заказов.</p>
                
                <h2>2. Условия пользования сайтом</h2>
                <p>2.1. Пользователь соглашается:</p>
                <ul>
                    <li>Не использовать сайт в незаконных целях</li>
                    <li>Не пытаться получить несанкционированный доступ к данным</li>
                    <li>Не размещать вредоносный код</li>
                    <li>Соблюдать авторские права на контент</li>
                </ul>
                
                <h2>3. Регистрация и учетная запись</h2>
                <p>3.1. Для оформления заказа может потребоваться регистрация.</p>
                <p>3.2. Пользователь обязан предоставлять достоверные данные.</p>
                <p>3.3. Запрещено передавать учетные данные третьим лицам.</p>
                
                <h2>4. Оформление заказов</h2>
                <p>4.1. Заказ считается оформленным после подтверждения Магазином.</p>
                <p>4.2. Магазин оставляет за собой право отклонить заказ без объяснения причин.</p>
                <p>4.3. Цены на сайте могут быть изменены без предварительного уведомления.</p>
                
                <h2>5. Оплата и доставка</h2>
                <p>5.1. Доступные способы оплаты:</p>
                <ul>
                    <li>Банковские карты</li>
                    <li>Электронные платежи</li>
                    <li>Наложенный платеж</li>
                </ul>
                <p>5.2. Сроки и условия доставки указаны в соответствующем разделе сайта.</p>
                
                <h2>6. Возврат и обмен</h2>
                <p>6.1. Возврат товара осуществляется в соответствии с Законом о защите прав потребителей.</p>
                <p>6.2. Товары надлежащего качества принимаются к возврату в течение 14 дней.</p>
                <p>6.3. Для возврата необходимо сохранить товарный вид и упаковку.</p>
                
                <h2>7. Интеллектуальная собственность</h2>
                <p>7.1. Весь контент сайта (фото, тексты, дизайн) защищен авторским правом.</p>
                <p>7.2. Использование материалов сайта без согласия запрещено.</p>
                
                <h2>8. Изменения в политике</h2>
                <p>8.1. Магазин оставляет за собой право вносить изменения в настоящую Политику.</p>
                <p>8.2. Актуальная версия всегда доступна на этой странице.</p>
                
                <div class="contact-info">
                    <h3>Контакты</h3>
                    <p><i class="fas fa-envelope"></i> Email: <a href="mailto:info@50541.ru">info@50541.ru</a></p>
                    <p><i class="fas fa-phone"></i> Телефон: +7 (XXX) XXX-XX-XX</p>
                    <p>Режим работы: Пн-Пт с 9:00 до 18:00</p>
                </div>
            </div>
        </div>
    </main>
    
    <?php
    require_once $footer_path;
    ?>
</body>
</html>