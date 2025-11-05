<?php
/* Smarty version 5.5.1, created on 2025-11-05 20:10:24
  from 'file:menu_principal.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_690ba120a53291_54637804',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f15151adb778f2df545f37031c725f6f15c742ee' => 
    array (
      0 => 'menu_principal.tpl',
      1 => 1762369810,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690ba120a53291_54637804 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Proyecto_OO_2025 - MVC\\View\\templates';
?><div class="dashboard-container">
    <h2>👋 ¡Bienvenido, <?php echo (($tmp = $_smarty_tpl->getValue('username') ?? null)===null||$tmp==='' ? 'Admin' ?? null : $tmp);?>
!</h2>
    <p>Resumen rápido del estado actual del refugio:</p>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-icon">🐾</span>
            <h3><?php echo $_smarty_tpl->getValue('stats')['animales_totales'];?>
</h3>
            <p>Animales Totales</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">❤️</span>
            <h3><?php echo $_smarty_tpl->getValue('stats')['animales_listos'];?>
</h3>
            <p>Listos para Adopción</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">🏠</span>
            <h3><?php echo $_smarty_tpl->getValue('stats')['adopciones_totales'];?>
</h3>
            <p>Adopciones Completadas</p>
        </div>
        <div class="stat-card">
            <span class="stat-icon">👤</span>
            <h3><?php echo $_smarty_tpl->getValue('stats')['adoptantes_habilitados'];?>
</h3>
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

<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
><?php }
}
