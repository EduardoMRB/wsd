<?php

require_once ('../config/config.php');
require_once (DIR_APP.'config/smarty.php');

$header = new Template();

$header->display('view/header.inc.htm');