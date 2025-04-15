<?php
session_start(); // Обязательно в первой строке файла
// Дальше ваш обычный код...
?>
<!DOCTYPE html>
<html lang="ru">
<?php
$head_path = __DIR__ . "/includes/head.php";
$header_path = __DIR__ . "/includes/header.php";
$footer_path = __DIR__ . "/includes/footer.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты | 50541</title>
    <?php
    require_once $header_path;
    require_once $head_path;
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Основные стили страницы */
        body {
            background-color: #ded2c2 !important; /* Основной фон сайта */
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Шапка с другим цветом */
        header {
            background-color: #eee7dd !important; /* Цвет шапки */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 100;
        }

        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: transparent;
        }

        /* Стили для контактной секции */
        .contacts-section {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 800px;
        }

        .contacts-section h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .contact-card {
            flex: 1;
            min-width: 250px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            text-align: center;
        }

        .contact-card h2 {
            font-size: 20px;
            color: #ff6b6b;
            margin-bottom: 15px;
        }

        .contact-card p, .contact-card a {
            margin: 8px 0;
            color: #555;
            text-decoration: none;
        }

        .contact-card a:hover {
            color: #ff6b6b;
        }

        .contact-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #ff6b6b;
        }

        /* Карта */
        .map-container {
            margin-top: 40px;
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="page-container">

        <section class="contacts-section">
            <h1>Наши контакты</h1>

            <div class="contact-info">
                <div class="contact-card">
                    <h2><i class="contact-icon"></i> Адрес</h2>
                    <p>г. Нижний Новгород, ул. Пашкова, д. 78</p>
                    <p>ТЦ "Барбос и Бобик", 5 этаж</p>
                </div>

                <div class="contact-card">
                    <h2><i class="contact-icon"></i> Телефоны</h2>
                    <p>+7 (787) 878-56-78</p>
                    <p>+7 (000) 000-00-00</p>
                </div>

                <div class="contact-card">
                    <h2><i class="contact-icon">✉️</i> Электронная почта</h2>
                    <p><a href="mailto:info@50541.ru">info@50541.ru</a></p>
                    <p><a href="mailto:support@50541.ru">support@50541.ru</a></p>
                </div>

                <div class="contact-card">
                    <h2><i class="contact-icon">⏰</i> Часы работы</h2>
                    <p>Пн-Пт: 05:00 - 20:00</p>
                    <p>Сб-Вс: 05:00 - 20:30</p>
                </div>

                <!-- Добавление карточек социальных сетей -->
                <div class="contact-card">
                    <h2><i class="contact-icon fab fa-vk"></i> ВКонтакте</h2>
                    <p><a href="https://vk.com/babushkin.pogrebok?from=groups" target="_blank">Наша группа ВК</a></p>
                </div>

                <div class="contact-card">
                    <h2><i class="contact-icon fab fa-telegram"></i> Telegram</h2>
                    <p><a href="https://t.me/shop50541" target="_blank">Наш канал в Telegram</a></p>
                </div>

                <div class="contact-card">
                    <h2><i class="contact-icon fab fa-instagram"></i> Instagram</h2>
                    <p><a href="https://vk.com/com_instagram" target="_blank">Наш Instagram "Запрещённо на территории РФ"</a></p>
                </div>

            </div>

            <div class="map-container">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A1a2b3c4d5e6f7g8h9i0j&amp;source=constructor"
                    width="100%" height="400"
                    title="Карта с местоположением магазина 50541"
                    aria-label="Карта с местоположением магазина 50541">
                </iframe>
            </div>

        </section>

    </div>
    <?php require_once $footer_path; ?>
</body>
</html>