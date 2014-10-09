<?php /* Smarty version Smarty-3.1.18, created on 2014-10-08 22:25:14
         compiled from "apartamento.inc.htm" */ ?>
<?php /*%%SmartyHeaderCode:8151444975435ebce3ec961-75668622%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29da51d321f1a2176327cd088591250de39fd563' => 
    array (
      0 => 'apartamento.inc.htm',
      1 => 1412821512,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8151444975435ebce3ec961-75668622',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5435ebce40f4f5_95135008',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5435ebce40f4f5_95135008')) {function content_5435ebce40f4f5_95135008($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.inc.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<?php echo $_smarty_tpl->getSubTemplate ("footer.inc.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
