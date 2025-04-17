<?php
session_start(); // Обязательно в первой строке файла

// Подключение к базе данных
require_once __DIR__ . "/connection.php";

// Получаем данные сотрудников
$employees = [];
$query = "SELECT first_name, last_name, position, photo_path FROM employees";
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    $result->free();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>О нашей компании | 50541</title>
    <?php 
    $head_path = __DIR__ . "/includes/head.php";
    require_once $head_path; 
    ?>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Специфичные стили только для страницы "О нас" */
        .about-section {
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .about-section h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }
        
        .about-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin-bottom: 50px;
        }
        
        .about-text {
            flex: 1;
            min-width: 300px;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .about-text h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ff6b6b;
        }
        
        .about-image {
            flex: 1;
            min-width: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .about-image img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .team-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center; /* Центрируем карточки по горизонтали */
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .team-member {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 2px solid white;
            width: 250px; /* Фиксированная ширина карточки */
            flex-shrink: 0; /* Запрещаем уменьшение ширины */
        }
        
        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #ff6b6b;
            box-shadow: 0 0 0 5px white;
        }
        
        .team-member h3 {
            font-size: 18px;
            margin-bottom: 5px;
            padding: 10px;
            background: white;
            border-radius: 5px;
            border: 2px solid white;
        }
        
        .team-member p {
            color: #666;
            font-size: 14px;
            padding: 10px;
            background: white;
            border-radius: 5px;
            border: 2px solid white;
            margin: 0;
        }
        
        /* Стили для центрирования заголовка и секции */
        .team-section {
            text-align: center;
            width: 100%;
        }
        
        .team-section h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php
    $header_path = __DIR__ . "/includes/header.php";
    require_once $header_path;
    ?>
    
    <main class="about-section">
        <h1>О нашей компании</h1>
        
        <div class="about-content">
            <div class="about-text">
                <h2>Наша история</h2>
                <p>50541 - это современный бренд одежды, основанный в 2025 году с целью создания качественной и стильной одежды для повседневной носки, особенностью которого является ливитированость! Начиная с небольшой идеи, мы выросли в компанию с общественным признанием.</p>
                <p>Наша философия проста: победитель забирает своё, остальные смотрят. Не упусти свой шанс, который может вновь и не наступить!</p>
                
                <h2>Наши ценности</h2>
                <p>Мы верим в устойчивое развитие и ответственное производство. Все наши материалы сертифицированы, а производственные процессы соответствуют самым высоким стандартам экологической безопасности.</p>
                <p>Клиенты для нас - это часть нашей уникальной семьи. Мы ценим каждого покупателя и стремимся создать для вас лучшие продукты.</p>
            </div>
            
            <div class="about-image">
                <img src="images/about-us.jpg" alt="Наш магазин">
            </div>
        </div>
        
        <div class="team-section">
            <h2>Наши сотрудники</h2>
            <div class="team-grid">
                <?php foreach ($employees as $employee): ?>
                    <div class="team-member">
                        <img src="<?= htmlspecialchars($employee['photo_path']) ?>" alt="<?= htmlspecialchars($employee['first_name']) ?>">
                        <h3><?= htmlspecialchars($employee['first_name']) . ' ' . htmlspecialchars($employee['last_name']) ?></h3>
                        <p><?= htmlspecialchars($employee['position']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    
    <?php 
    $footer_path = __DIR__ . "/includes/footer.php";
    require_once $footer_path; 
    ?>
</body>
</html>