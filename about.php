<!DOCTYPE html>
<html lang="ru">
<?php
$head_path = __DIR__ . "/includes/head.php";
$header_path = __DIR__ . "/includes/header.php";
$footer_path = __DIR__ . "/includes/footer.php";
?>
<head>
    <title>О нашей компании | 50541</title>
    <?php require_once $head_path; ?>
    <style>
        /* Стили для страницы "О нас" */
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
        }
        
        .about-text h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ff6b6b;
        }
        
        .about-text p {
            margin-bottom: 15px;
            line-height: 1.6;
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
        
        .team-section {
            margin-top: 50px;
        }
        
        .team-section h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 40px;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .team-member {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #ff6b6b;
        }
        
        .team-member h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .team-member p {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php
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
            <h2>Наша команда</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="images/team1.jpg" alt="Дмитрий">
                    <h3>Дмитрий Касаткин</h3>
                    <p>Основатель и креативный директор</p>
                </div>
                <div class="team-member">
                    <img src="images/team2.jpg" alt="Владислав">
                    <h3>Владислав Селькин</h3>
                    <p>Главный дизайнер</p>
                </div>
                <div class="team-member">
                    <img src="images/team3.jpg" alt="Бубедон">
                    <h3>Ариэль Бубедон</h3>
                    <p>Менеджер по продажам</p>
                </div>
                <div class="team-member">
                    <img src="images/team4.jpg" alt="Михаил">
                    <h3>Михаил Круг</h3>
                    <p>Маркетинг</p>
                </div>
            </div>
        </div>
    </main>
    
    <?php require_once $footer_path; ?>
</body>
</html>