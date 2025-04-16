<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Фотогалерея | 50541</title>
    <?php
    require_once __DIR__ . "/connection.php";
    $header_path = __DIR__ . "/includes/header.php";
    $banner_path = __DIR__ . "/includes/banner.php";
    $footer_path = __DIR__ . "/includes/footer.php";
    $head_path = __DIR__ . "/includes/head.php";
    
    // Получаем избранные фотографии из галереи
    $query = "SELECT * FROM gallery WHERE is_featured = 1 ORDER BY created_at DESC";
    $result = $conn->query($query);
    $featured_photos = [];
    if ($result) {
        $featured_photos = $result->fetch_all(MYSQLI_ASSOC);
    }
    
    require_once $head_path;
    ?>
    <style>
        .gallery-section {
            padding: 40px 5%;
            margin: 0 auto;
            background-color: transparent;
            position: relative;
            max-width: 1400px;
        }
        
        .gallery-frame {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .gallery-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        
        .gallery-track {
            display: flex;
            transition: transform 0.5s ease;
            will-change: transform;
        }
        
        .gallery-item {
            flex: 0 0 100%;
            padding: 0 10px;
            box-sizing: border-box;
        }
        
        @media (min-width: 576px) {
            .gallery-item {
                flex: 0 0 50%;
            }
        }
        
        @media (min-width: 992px) {
            .gallery-item {
                flex: 0 0 25%;
            }
        }
        
        .gallery-image-container {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .gallery-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-image-container img {
            transform: scale(1.05);
        }
        
        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #ff6b6b;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 24px;
            z-index: 20;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }
        
        .nav-arrow:hover {
            background-color: #ff5252;
            transform: translateY(-50%) scale(1.1);
        }
        
        .prev-arrow {
            left: 0;
            transform: translate(-50%, -50%);
        }
        
        .next-arrow {
            right: 0;
            transform: translate(50%, -50%);
        }
        
        .gallery-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }
        
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .dot.active {
            background-color: #ff6b6b;
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <?php
    require_once $header_path;
    require_once $banner_path;
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
            const itemCount = items.length / 2;
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
                currentIndex = index;
                const visibleItems = getVisibleItems();
                const offset = -currentIndex * 100 / visibleItems;
                
                track.style.transition = 'transform 0.5s ease';
                track.style.transform = `translateX(${offset}%)`;
                
                updateDots(currentIndex % (itemCount / visibleItems));
                
                setTimeout(() => {
                    isAnimating = false;
                    
                    if (currentIndex >= itemCount) {
                        track.style.transition = 'none';
                        currentIndex = 0;
                        track.style.transform = `translateX(0%)`;
                    }
                    else if (currentIndex < 0) {
                        track.style.transition = 'none';
                        currentIndex = itemCount - visibleItems;
                        track.style.transform = `translateX(${-currentIndex * 100 / visibleItems}%)`;
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
                    const visibleItems = getVisibleItems();
                    moveToIndex(index * visibleItems);
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