<?php
// Carrega a biblioteca Smarty
require ('config.php');
require(SMARTY_DIR.'Smarty.class.php');

// O arquivo setup.php é um bom lugar para carregar
// arquivos necessarios para a aplicação e você
// pode faze-lo aqui mesmo. Um exemplo:
// require('guestbook/guestbook.lib.php');

class Template extends Smarty {

    public function __construct()
    {

        parent::__construct();
        $this->template_dir = DIR_APP.'/';
        $this->compile_dir  = SMARTY_FOLDERS.'compiled/';
        $this->config_dir   = SMARTY_FOLDERS.'configs/';
        $this->cache_dir    = SMARTY_FOLDERS.'cache/';

        $this->caching = false;
        $this->assign('app_name', 'PHPUNIT');
    }

}

