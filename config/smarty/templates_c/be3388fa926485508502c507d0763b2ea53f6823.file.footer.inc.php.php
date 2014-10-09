<?php /* Smarty version Smarty-3.1.18, created on 2014-10-08 22:26:30
         compiled from "footer.inc.php" */ ?>
<?php /*%%SmartyHeaderCode:20110500015435ed21319ac7-54029341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be3388fa926485508502c507d0763b2ea53f6823' => 
    array (
      0 => 'footer.inc.php',
      1 => 1412821587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20110500015435ed21319ac7-54029341',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5435ed2131bac2_84205709',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5435ed2131bac2_84205709')) {function content_5435ed2131bac2_84205709($_smarty_tpl) {?><<?php ?>?php

require_once ('../config/config.php');
require_once (DIR_APP.'controller/Apartamento.php');
require_once (DIR_APP.'config/smarty.php');

$template = new Template();

$template->assign('msg', 'testando smarty');

$template->display('apartamento.inc.htm');<?php }} ?>
