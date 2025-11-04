<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titulo|default:"Refugio de Adopciones"}</title>
    <link rel="stylesheet" href="{$CSS_PATH}"> 
</head>
<body>
    <header>
        {* Título estático requerido *}
        <h1>Sistema de Gestión de Animales</h1> 
        <nav>
            <ul>
                {* El menú horizontal *}
    
            {foreach $nav_items as $item}
                    <li><a href="{$item.url}">{$item.nombre}</a></li>
                {/foreach}
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
        <p>&copy;
2025. Gestión de Adopciones.</p>
    </footer>
</body>
</html>