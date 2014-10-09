<?php

require_once ('../config/config.php');
require_once (DIR_APP.'controller/Apartamento.php');
require_once (DIR_APP.'config/smarty.php');

$template = new Template();

$con = new Connection();
$apartamento = new Apartamento($con);

$template->assign('apartamentos', $apartamento->selectData());

$template->display('view/apartamento.inc.htm');