<?php
ini_set('display_errors', 1);

session_start();

require_once('controller/Connection.php');
require_once('controller/Apartamento.php');
require_once('controller/Despesa.php');
require_once('vendor/autoload.php');

$app = new \Slim\Slim(array(
	'debug' => true,
	'templates.path' => 'view',
));

$con = new Connection();

$app->get('/', function() use ($app, $con){

	$apartamento = new Apartamento($con);

	$data['apartamentos'] = $apartamento->selectData();

	$app->render('index.inc.php', $data);

})->name('home');

$app->group('/apartamento', function() use ($app, $con){

	$app->get('/new', function() use ($app, $con){

		$app->render('apartamentos/novo.inc.php');

	})->name('new');

	$app->post('/new', function() use ($app, $con){

		$request = $app->request;
		$apartamento = new Apartamento($con);
		$apartamento->setMorador($request->post('morador'));
		$apartamento->setMeses($request->post('meses'));
		$apartamento->setNumero($request->post('numero'));
		$apartamento->setSaldo($request->post('saldo'));
		
		if($apartamento->insertData($apartamento))
			$app->flash('message', 'Dados inseridos com sucesso');
		else
			$app->flash('error', 'Houve um erro ao inserir os dados');

		$redirect = $app->urlFor('new');

		$app->redirect($redirect);

	});

	$app->get('/edit/:id', function($id=0) use ($app, $con){

		$apartamento = new Apartamento($con);

		$data['apartamentos'] = $apartamento->editData($id);
		$app->render('apartamentos/editar.inc.php', $data);

	})->name('editApartamento');

	$app->post('/edit/:id', function($id) use ($app, $con){

		$id = (int)$id;

		$request = $app->request;

		$apartamento = new Apartamento($con);
		$apartamento->setMorador($request->post('morador'));
		$apartamento->setSaldo($request->post('saldo'));
		$apartamento->setNumero($request->post('numero'));
		$apartamento->setMeses($request->post('meses'));
		$apartamento->setId($id);

		if($apartamento->updateData($apartamento))
			$app->flash('message', 'Dados do morador atualizado com sucesso');
		else
			$app->flash('error', 'Houve um erro ao atualizar os dados');

		$redirect = $app->urlFor('editApartamento', array('id' => $id));

		$app->redirect($redirect);

	});

	$app->get('/delete/:id', function($id=0) use ($app, $con){

		$apartamento = new Apartamento($con);

		if($apartamento->deleteData($id))
			$app->flash('message', 'Apartamento deletado com sucesso');
		else
			$app->flash('error', 'Houve um erro ao tentar deletar os dados');

		$redirect = $app->urlFor('home');

		$app->redirect($redirect);

	});

});

/* MODULO DE DESPESAS */

$app->group('/despesas' , function() use ($app, $con){

	$app->get('/home', function() use ($app, $con){

		$despesa = new Despesa($con);

		$data['despesas'] = $despesa->selectData();

		$app->render('despesas/index.inc.php', $data);

	})->name('homeDespesas');

	$app->get('/new', function() use ($app, $con){

		$app->render('despesas/novo.inc.php');

	})->name('newDespesa');

	$app->get('/view/:id', function($id) use ($app, $con){

		$id = (int)$id;

		$despesa = new Despesa($con); 

		$data['despesas'] = $despesa->selectById($id);

		$app->render('despesas/report.inc.php', $data);

	})->name('viewDespesa');

	$app->post('/new', function() use ($app, $con){

		$request = $app->request;
		$despesa = new Despesa($con);
		$despesa->setMes($request->post('mes'));
		$despesa->setAno($request->post('ano'));
		$despesa->setVencimento($request->post('vencimento'));
		$despesa->setValor($request->post('valor'));
		$despesa->setDescricao($request->post('descricao'));
		
		if($despesa->insertData($despesa))
			$app->flash('message', 'Dados inseridos com sucesso');
		else
			$app->flash('error', 'Houve um erro ao inserir os dados');

		$redirect = $app->urlFor('newDespesa');

		$app->redirect($redirect);

	});

	$app->get('/edit/:id', function($id=0) use ($app, $con){

		$despesa = new Despesa($con);

		$data['despesas'] = $despesa->selectById($id);
		$data['allDespesas'] = $despesa->selectDespesaById($id);
		$app->render('despesas/editar.inc.php', $data);

	})->name('editDespesa');

	$app->post('/edit/:id', function($id) use ($app, $con){

		$id = (int)$id;

		$request = $app->request;

		$despesa = new Despesa($con);
		$despesa->setMes($request->post('mes'));
		$despesa->setAno($request->post('ano'));
		$despesa->setVencimento($request->post('vencimento'));
		$despesa->setValor($request->post('valor'));
		$despesa->setDescricao($request->post('descricao'));
		$despesa->setIdDespesa($request->post('idDespesa'));
		$despesa->setId($id);

		if($despesa->updateData($despesa))
			$app->flash('message', 'Despesa atualizada com sucesso');
		else
			$app->flash('error', 'Houve um erro ao atualizar os dados');

		$redirect = $app->urlFor('editDespesa', array('id' => $id));

		$app->redirect($redirect);

	});

	$app->get('/delete/:id', function($id=0) use ($app, $con){

		$despesa = new Despesa($con);

		if($despesa->deleteData($id))
			$app->flash('message', 'Despesa deletada com sucesso');
		else
			$app->flash('error', 'Houve um erro ao tentar deletar os dados');

		$redirect = $app->urlFor('homeDespesas');

		$app->redirect($redirect);

	});

	$app->get('/reporter/:id', function($id=0) use ($app, $con){

		$despesa = new Despesa($con);

		$data['despesas'] = $despesa->selectById($id);

		$app->render('despesas/report.inc.php', $data);

	});

});

$app->run();