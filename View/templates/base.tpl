<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titulo|default:"Refugio de Adopciones"}</title>
    <link rel="stylesheet" href="{$CSS_PATH}"> 
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <header>
        <h1>Sistema de Gestión de Animales</h1> 
        <nav>
            <ul>
            {if $nav_items}
                {foreach $nav_items as $item}
                    <li><a href="{$item.url}">{$item.nombre}</a></li>
                {/foreach}
            {/if}
            </ul>
        </nav>
    </header>

    <main class="main-content-container"> 
        {if isset($smarty.get.msg)}
            <p class="alerta exito">{$smarty.get.msg}</p>
        {/if}
        
        {include file=$contenido_tpl}
    </main>

    <footer>
        <p>&copy; 2025. Gestión de Adopciones.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>