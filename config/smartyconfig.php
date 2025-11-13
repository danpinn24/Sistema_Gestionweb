<?php
require_once __DIR__ . '/../librerias/smarty-5.5.1/libs/Smarty.class.php';

use Smarty\Smarty; 

function inicializarSmarty() {
$smarty = new Smarty(); 

$smarty->setCaching(Smarty::CACHING_OFF);
$smarty->setCompileCheck(true);

$root_path = dirname(__DIR__); 

$smarty->setTemplateDir($root_path . '/View/templates/'); 
$smarty->setCompileDir($root_path . '/View/templates_c/'); 
$smarty->setCacheDir($root_path . '/View/cache/'); 
$smarty->setConfigDir($root_path . '/config/configs/');
$smarty->assign('CSS_PATH', 'style.css');

 return $smarty;
}
?>