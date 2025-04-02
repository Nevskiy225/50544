document.addEventListener('DOMContentLoaded', function() {
  // Инициализация функционала поиска
  const searchInput = document.querySelector('.search-bar input');
  const searchIcon = document.querySelector('.search-bar i');
  
  searchIcon.addEventListener('click', function() {
    performSearch(searchInput.value);
  });
  
  searchInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      performSearch(searchInput.value);
    }
  });
  
  // Функция поиска
  function performSearch(query) {
    if (query.trim() !== '') {
      alert('Поиск: ' + query);
      // Здесь можно добавить реальную логику поиска
    }
  }
  
  // Имитация данных курсов
  const coursesData = [
    {
      title: 'Веб-разработка с нуля до PRO',
      price: 99,
      rating: 4.9,
      duration: '120 часов',
      description: 'Полный курс по современной веб-разработке, включая HTML, CSS, JavaScript и фреймворки.'
    },
    {
      title: 'Маркетинг в социальных сетях',
      price: 79,
      rating: 4.7,
      duration: '80 часов',
      description: 'Научитесь эффективно продвигать бизнес в Facebook, Instagram и других социальных сетях.'
    },
    {
      title: 'Data Science для начинающих',
      price: 129,
      rating: 4.8,
      duration: '150 часов',
      description: 'Основы анализа данных, машинного обучения и визуализации на Python.'
    }
  ];
  
  // Динамическая загрузка курсов
  const coursesContainer = document.querySelector('.courses');
  
  function loadCourses() {
    coursesContainer.innerHTML = '';
    
    coursesData.forEach(course => {
      const courseCard = document.createElement('div');
      courseCard.className = 'course-card';
      
      courseCard.innerHTML = `
        <div class="course-img">
          <div class="course-price">$${course.price}</div>
        </div>
        <div class="course-info">
          <h3>${course.title}</h3>
          <div class="course-meta">
            <span class="course-rating">
              <i class="fas fa-star"></i> ${course.rating}
            </span>
            <span>${course.duration}</span>
          </div>
          <p class="course-desc">${course.description}</p>
          <a href="#" class="course-btn">Подробнее</a>
        </div>
      `;
      
      coursesContainer.appendChild(courseCard);
    });
    
    // Добавляем обработчики событий для кнопок курсов
    document.querySelectorAll('.course-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const courseTitle = this.closest('.course-card').querySelector('h3').textContent;
        alert(`Вы выбрали курс: ${courseTitle}`);
      });
    });
  }
  
  // Инициализация загрузки курсов
  loadCourses();
  
  // Обработчики для кнопок авторизации
  document.querySelector('.login').addEventListener('click', function(e) {
    e.preventDefault();
    showAuthModal('login');
  });
  
  document.querySelector('.register').addEventListener('click', function(e) {
    e.preventDefault();
    showAuthModal('register');
  });
  
  // Функция показа модального окна авторизации
  function showAuthModal(type) {
    const modal = document.createElement('div');
    modal.className = 'auth-modal';
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.backgroundColor = 'rgba(0,0,0,0.7)';
    modal.style.display = 'flex';
    modal.style.justifyContent = 'center';
    modal.style.alignItems = 'center';
    modal.style.zIndex = '1000';
    
    const modalContent = document.createElement('div');
    modalContent.className = 'auth-modal-content';
    modalContent.style.backgroundColor = 'white';
    modalContent.style.padding = '30px';
    modalContent.style.borderRadius = '8px';
    modalContent.style.width = '400px';
    modalContent.style.maxWidth = '90%';
    
    if (type === 'login') {
      modalContent.innerHTML = `
        <h2>Вход в аккаунт</h2>
        <form id="loginForm">
          <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Email</label>
            <input type="email" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
          </div>
          <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Пароль</label>
            <input type="password" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
          </div>
          <button type="submit" style="width: 100%; padding: 10px; background-color: var(--secondary-color); color: white; border: none; border-radius: 4px; cursor: pointer;">Войти</button>
        </form>
        <p style="margin-top: 15px; text-align: center;">
          Нет аккаунта? <a href="#" class="switch-to-register" style="color: var(--secondary-color);">Зарегистрироваться</a>
        </p>
      `;
    } else {
      modalContent.innerHTML = `
        <h2>Регистрация</h2>
        <form id="registerForm">
          <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Имя</label>
            <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
          </div>
          <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Email</label>
            <input type="email" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
          </div>
          <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Пароль</label>
            <input type="password" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
          </div>
          <button type="submit" style="width: 100%; padding: 10px; background-color: var(--secondary-color); color: white; border: none; border-radius: 4px; cursor: pointer;">Зарегистрироваться</button>
        </form>
        <p style="margin-top: 15px; text-align: center;">
          Уже есть аккаунт? <a href="#" class="switch-to-login" style="color: var(--secondary-color);">Войти</a>
        </p>
      `;
    }
    
    modalContent.querySelector('form').addEventListener('submit', function(e) {
      e.preventDefault();
      alert(type === 'login' ? 'Вы успешно вошли!' : 'Регистрация прошла успешно!');
      modal.remove();
    });
    
    const closeBtn = document.createElement('span');
    closeBtn.innerHTML = '&times;';
    closeBtn.style.position = 'absolute';
    closeBtn.style.top = '10px';
    closeBtn.style.right = '10px';
    closeBtn.style.fontSize = '24px';
    closeBtn.style.cursor = 'pointer';
    
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
    
    modalContent.appendChild(closeBtn);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
    
    // Переключение между логином и регистрацией
    const switchLink = modalContent.querySelector(type === 'login' ? '.switch-to-register' : '.switch-to-login');
    if (switchLink) {
      switchLink.addEventListener('click', function(e) {
        e.preventDefault();
        modal.remove();
        showAuthModal(type === 'login' ? 'register' : 'login');
      });
    }
  }
  
  // Обработчики для кнопок героя
  document.querySelector('.primary-btn').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Начать обучение - переход к каталогу курсов');
  });
  
  document.querySelector('.secondary-btn').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Стать преподавателем - переход к форме регистрации преподавателя');
  });
});