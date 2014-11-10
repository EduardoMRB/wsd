<?php /* Smarty version 2.6.28, created on 2014-10-08 23:44:47
         compiled from view/apartamento.inc.htm */ ?>
<?php include("header.inc.php") ?>

<table border="1">
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>Nome do morador</th>
	<th>Número do Ap</th>
	<th>Saldo devedor</th>
	<th>Meses atrasados</th>
<?php $_from = $this->_tpl_vars['apartamentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>
	<tr>
		<td align="center"> <a href="/controller/apartamento/view"><img src="/phpunit/images/view.png" with="25" height="25" /></a> </td>
		<td align="center"> <a href="#"><img src="../images/delete.png" with="25" height="25" /></a> </td>
		<td align="center"> <a href="#"><img src="../images/edit.png" with="25" height="25" /></a> </td>
		<td align="center"><?php echo $this->_tpl_vars['result']->morador; ?>
</td>
		<td align="center"><?php echo $this->_tpl_vars['result']->numero; ?>
</td>
		<td><?php echo $this->_tpl_vars['result']->saldo; ?>
</td>
		<td><?php echo $this->_tpl_vars['result']->meses_devedores; ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php include("footer.inc.php") ?>