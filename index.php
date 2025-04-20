<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Магазин одежды | 50541</title>
    <link rel="stylesheet" href="css/index.css">
    
    <?php
    require_once __DIR__ . "/connection.php";
    $header_path = __DIR__ . "/includes/header.php";
    $banner_path = __DIR__ . "/includes/banner.php";
    $footer_path = __DIR__ . "/includes/footer.php";
    $head_path = __DIR__ . "/includes/head.php";
    $chatbot = __DIR__ . "/includes/chatbot.php";
    
    // Получаем избранные фотографии из галереи
    $query = "SELECT * FROM gallery WHERE is_featured = 1 ORDER BY created_at DESC";
    $result = $conn->query($query);
    $featured_photos = [];
    if ($result) {
        $featured_photos = $result->fetch_all(MYSQLI_ASSOC);
    }
    
    require_once $head_path;
    ?>
</head>
<body>
    <?php
    require_once $header_path;
    require_once $banner_path;
  require_once $chatbot;
    ?>
    
    <main class="gallery-section">
        <h1>Избранные фотографии</h1>
        
        <div class="gallery-frame">
            <?php if (!empty($featured_photos)): ?>
                <div class="gallery-container">
                    <div class="gallery-track" id="galleryTrack">
                        <?php foreach (array_merge($featured_photos, $featured_photos) as $photo): ?>
                            <div class="gallery-item">
                                <div class="gallery-image-container">
                                    <img src="<?= htmlspecialchars($photo['image_path']) ?>" 
                                         alt="<?= htmlspecialchars($photo['title']) ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <button class="nav-arrow prev-arrow">&#10094;</button>
                <button class="nav-arrow next-arrow">&#10095;</button>
                
                <div class="gallery-dots" id="galleryDots">
                    <?php foreach ($featured_photos as $index => $photo): ?>
                        <div class="dot <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>"></div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p style="text-align: center;">Нет избранных фотографий для отображения</p>
            <?php endif; ?>
        </div>
    </main>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('galleryTrack');
        const prevBtn = document.querySelector('.prev-arrow');
        const nextBtn = document.querySelector('.next-arrow');
        const dots = document.querySelectorAll('.dot');
        const items = document.querySelectorAll('.gallery-item');
        const itemCount = <?= count($featured_photos) ?>; // Количество уникальных фото
        let currentIndex = 0;
        let autoSlideInterval;
        let isAnimating = false;
        
        function getVisibleItems() {
            const style = window.getComputedStyle(items[0]);
            return style.flexBasis === '100%' ? 1 : 
                   style.flexBasis === '50%' ? 2 : 4;
        }
        
        function moveToIndex(index) {
            if (isAnimating) return;
            
            isAnimating = true;
            const visibleItems = getVisibleItems();
            let normalizedIndex = index;
            
            // Нормализуем индекс для бесконечной прокрутки
            if (index >= itemCount) {
                normalizedIndex = 0;
            } else if (index < 0) {
                normalizedIndex = itemCount - 1;
            }
            
            currentIndex = normalizedIndex;
            const offset = -currentIndex * 100 / visibleItems;
            
            track.style.transition = 'transform 0.5s ease';
            track.style.transform = `translateX(${offset}%)`;
            
            updateDots(currentIndex);
            
            setTimeout(() => {
                isAnimating = false;
                
                // Если мы достигли "клонированной" части, мгновенно переходим к оригиналу
                if (index !== normalizedIndex) {
                    track.style.transition = 'none';
                    moveToIndex(normalizedIndex);
                }
            }, 500);
        }
        
        function updateDots(index) {
            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('active', dotIndex === index);
            });
        }
        
        function prevSlide() {
            moveToIndex(currentIndex - 1);
            resetAutoSlide();
        }
        
        function nextSlide() {
            moveToIndex(currentIndex + 1);
            resetAutoSlide();
        }
        
        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 3000);
        }
        
        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }
        
        prevBtn.addEventListener('click', prevSlide);
        nextBtn.addEventListener('click', nextSlide);
        
        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                moveToIndex(index);
                resetAutoSlide();
            });
        });
        
        window.addEventListener('resize', function() {
            const visibleItems = getVisibleItems();
            track.style.transform = `translateX(${-currentIndex * 100 / visibleItems}%)`;
        });
        
        startAutoSlide();
        
        track.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });
        
        track.addEventListener('mouseleave', startAutoSlide);
    });
</script>
    
    <?php
    require_once $footer_path;
    ?>
</body>
</html>