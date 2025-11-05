<div class="dashboard-container">
    <h2>👋 ¡Bienvenido, {$username|default:'Admin'}!</h2>
    <p>Resumen rápido del estado actual del refugio:</p>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-icon">🐾</span>
            <h3>{$stats.animales_totales}</h3>
            <p>Animales Totales</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">❤️</span>
            <h3>{$stats.animales_listos}</h3>
            <p>Listos para Adopción</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">🏠</span>
            <h3>{$stats.adopciones_totales}</h3>
            <p>Adopciones Completadas</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">👤</span>
            <h3>{$stats.adoptantes_habilitados}</h3>
            <p>Adoptantes Habilitados</p>
        </div>
    </div>

    <div class="carousel-container">
        <h3>Nuestra Familia</h3>
        
        <div class="swiper miCarrusel">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide">
                    <img src="https://placedog.net/500/500?id=10" alt="Foto perro 1">
                    <div class="slide-info"><strong>¡Adopta!</strong></div>
                </div>
                <div class="swiper-slide">
                    <img src="https://placedog.net/500/500?id=11" alt="Foto perro 2">
                    <div class="slide-info"><strong>¡Adopta!</strong></div>
                </div>
                <div class="swiper-slide">
                    <img src="https://placedog.net/500/500?id=12" alt="Foto perro 3">
                    <div class="slide-info"><strong>¡Adopta!</strong></div>
                </div>
                <div class="swiper-slide">
                    <img src="https://placedog.net/500/500?id=14" alt="Foto perro 4">
                    <div class="slide-info"><strong>¡Adopta!</strong></div>
                </div>
                
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.miCarrusel', {
            loop: true,
            slidesPerView: 3, // Mostrar 3 slides
            spaceBetween: 20, 
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>