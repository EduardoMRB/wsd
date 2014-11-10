<?php

require_once('autoload.php');

$action = $_GET['action'];

switch($action){

	case '1':
		
		$con = new Connection();
		$despesa = new Despesa($con);
		$id = $_GET['id'];
		$despesa->deleteDespesa($id);

	break;

}