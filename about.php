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
    <link rel="stylesheet" href="css/about.css">
</head>
<body>
    <?php
    $header_path = __DIR__ . "/includes/header.php";
    require_once $header_path;
    ?>
    
    <main>
        <section class="about-section">
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
                <img src="images/gallery/about-us.jpg" alt="Наш магазин">
            </div>
        </div>
        
        <div class="team-section">
            <h2>Наша команда</h2>
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