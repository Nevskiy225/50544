<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Политика использования cookie | 50541</title>
    <?php
    require_once __DIR__ . "/connection.php";
    $header_path = __DIR__ . "/includes/header.php";
    $footer_path = __DIR__ . "/includes/footer.php";
    $head_path = __DIR__ . "/includes/head.php";
    
    require_once $head_path;
    ?>
    <style>
        /* Специфичные стили для страницы политики */
        .cookie-section {
            padding: 40px 5%;
            margin: 0 auto;
            background-color: transparent;
            max-width: 1200px;
        }
        
        .cookie-frame {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .cookie-title {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }
        
        .cookie-update {
            font-style: italic;
            color: #666;
            margin-bottom: 40px;
            text-align: center;
            display: block;
        }
        
        .cookie-content h2 {
            font-size: 1.8rem;
            margin: 40px 0 20px;
            color: #444;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .cookie-content h3 {
            font-size: 1.4rem;
            margin: 30px 0 15px;
            color: #444;
        }
        
        .cookie-content p {
            margin-bottom: 15px;
            color: #555;
            line-height: 1.6;
        }
        
        .cookie-content ul {
            margin-bottom: 20px;
            padding-left: 20px;
        }
        
        .cookie-content li {
            margin-bottom: 10px;
        }
        
        .cookie-content a {
            color: #ff6b6b;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .cookie-content a:hover {
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
            .cookie-frame {
                padding: 25px;
            }
            
            .cookie-title {
                font-size: 2rem;
            }
            
            .cookie-content h2 {
                font-size: 1.5rem;
            }
            
            .cookie-content h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <?php
    require_once $header_path;
    ?>
    
    <main class="cookie-section">
        <h1 class="cookie-title">Политика использования cookie</h1>
        
        <div class="cookie-frame">
            <span class="cookie-update">Последнее обновление: 15.04.2025</span>
            
            <div class="cookie-content">
                <h2>1. Что такое cookie?</h2>
                <p>1.1. Cookie — это небольшие текстовые файлы, которые веб-сайты сохраняют на вашем устройстве (компьютере, смартфоне или планшете), когда вы посещаете их. Они помогают сайтам запоминать информацию о вашем посещении, что делает последующее взаимодействие с этим сайтом более удобным.</p>
                
                <h2>2. Какие типы cookie мы используем</h2>
                <p>2.1. <strong>Необходимые cookie</strong> - обеспечивают работу основных функций сайта.</p>
                <p>2.2. <strong>Функциональные cookie</strong> - запоминают ваши предпочтения и настройки.</p>
                <p>2.3. <strong>Аналитические cookie</strong> - помогают нам понять, как посетители взаимодействуют с сайтом.</p>
                <p>2.4. <strong>Маркетинговые cookie</strong> - используются для показа релевантной рекламы.</p>
                
                <h2>3. Как мы используем cookie</h2>
                <p>3.1. Для обеспечения корректной работы сайта и его функций.</p>
                <p>3.2. Для анализа посещаемости и улучшения пользовательского опыта.</p>
                <p>3.3. Для персонализации контента и рекламных материалов.</p>
                <p>3.4. Для отслеживания эффективности маркетинговых кампаний.</p>
                
                <h2>4. Управление cookie</h2>
                <p>4.1. Вы можете управлять или удалять cookie по своему усмотрению через настройки браузера.</p>
                <p>4.2. Большинство браузеров позволяют:</p>
                <ul>
                    <li>Просматривать имеющиеся cookie и удалять их</li>
                    <li>Блокировать cookie третьих сторон</li>
                    <li>Блокировать cookie определенных сайтов</li>
                    <li>Блокировать все cookie</li>
                    <li>Удалять все cookie при закрытии браузера</li>
                </ul>
                <p>4.3. Обратите внимание: отключение cookie может повлиять на функциональность сайта.</p>
                
                <h2>5. Cookie третьих сторон</h2>
                <p>5.1. Мы можем использовать сервисы третьих сторон, которые также используют cookie:</p>
                <ul>
                    <li>Google Analytics - для анализа посещаемости</li>
                    <li>Facebook Pixel - для ремаркетинга</li>
                    <li>Yandex.Metrika - для веб-аналитики</li>
                </ul>
                <p>5.2. Мы не контролируем cookie, устанавливаемые третьими сторонами.</p>
                
                <h2>6. Изменения в политике</h2>
                <p>6.1. Мы можем периодически обновлять эту политику. Все изменения будут опубликованы на этой странице.</p>
                <p>6.2. Рекомендуем регулярно проверять эту политику на наличие обновлений.</p>
                
                <h2>7. Контактная информация</h2>
                <p>7.1. Если у вас есть вопросы относительно нашей политики использования cookie, пожалуйста, свяжитесь с нами:</p>
                
                <div class="contact-info">
                    <h3>Контактная информация:</h3>
                    <p><i class="fas fa-envelope"></i> Email: <a href="mailto:ravir.intl@mail.ru">ravir.intl@mail.ru</a></p>
                    <p>Для изменения настроек cookie или получения дополнительной информации направьте запрос на указанный email.</p>
                </div>
            </div>
        </div>
    </main>
    
    <?php
    require_once $footer_path;
    ?>
</body>
</html>