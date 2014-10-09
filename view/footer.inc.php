<?php

require_once ('../config/config.php');
require_once (DIR_APP.'config/smarty.php');

$footer = new Template();

$footer->display('view/footer.inc.htm');