<?php
ini_set('display_errors', 1);

session_start();

require __DIR__ . '/vendor/autoload.php';

use WSD\Entity\Apartamento;
use WSD\Entity\Despesa;
use WSD\Entity\Mes;
use WSD\Connection;
use WSD\Config\ConfigContainer;

$app = new \Slim\Slim(array(
    'debug' => true,
    'templates.path' => 'view',
    'view' => new Slim\Views\Twig(),
));

// load twig extensions
$view = $app->view();
$view->parserExtensions = array(
    new Slim\Views\TwigExtension()
);
$app->view($view);

// $container = new ConfigContainer(__DIR__ . '/config/config.yml');
// $con = new Connection($container);

$app->get('/', function() use ($app, $con){
    // $apartamento = new Apartamento($con);

    // $data['apartamentos'] = $apartamento->selectData();
    $data['apartamentos'] = [];

    $app->render('index.html.twig', $data);

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

        $mes = new Mes($con);

        $data['despesas'] = $mes->selectData();

        $app->render('despesas/index.inc.php', $data);

    })->name('homeDespesas');

    $app->get('/new', function() use ($app, $con){

        $app->render('despesas/novo.inc.php');

    })->name('newDespesa');

    $app->post('/new', function() use ($app, $con){

        $request = $app->request;
        $mes     = new Mes($con);
        $mes->setVencimento($request->post('vencimento'));
        $mes->setValorCondominio($request->post('valor'));
        $idMesRef = $mes->insertData($mes);

        $despesa = new Despesa($con);
        $despesa->setIdMesRef($idMesRef);
        $despesa->setDescricao($request->post('descricao'));
        $despesa->setValor($request->post('valorDespesa'));

        if($despesa->insertDespesa($despesa))
            $app->flash('message', 'Dados inseridos com sucesso');
        else
            $app->flash('error', 'Houve um erro ao inserir os dados');

        $redirect = $app->urlFor('newDespesa');

        $app->redirect($redirect);

    });

    $app->get('/view/:id', function($id) use ($app, $con){

        $id = (int)$id;

        $despesa = new Despesa($con); 

        $data['despesas'] = $despesa->selectById($id);

        $app->render('despesas/report.inc.php', $data);

    })->name('viewDespesa');

    $app->get('/edit/:id', function($id=0) use ($app, $con){

        $despesa = new Despesa($con);
        $mes 	 = new Mes($con);

        $data['despesas'] = $mes->selectById($id);
        $data['allDespesas'] = $despesa->selectDespesaById($id);
        $app->render('despesas/editar.inc.php', $data);

    })->name('editDespesa');

    $app->post('/edit/:id', function($id) use ($app, $con){

        $id = (int)$id;

        $request = $app->request;

        $mes     = new Mes($con);
        $mes->setVencimento($request->post('vencimento'));
        $mes->setValorCondominio($request->post('valor'));
        $mes->setId($id);
        $mes->updateData($mes);

        $despesa = new Despesa($con);
        $despesa->setIdMesRef($id);
        $despesa->setDescricao($request->post('descricao'));
        $despesa->setValor($request->post('valorDespesa'));
        $despesa->setIdDespesa($request->post('idDespesa'));

        if($despesa->updateData($despesa))
            $app->flash('message', 'Despesa atualizada com sucesso');
        else
            $app->flash('error', 'Houve um erro ao atualizar os dados');

        $redirect = $app->urlFor('editDespesa', array('id' => $id));

        $app->redirect($redirect);

    });

    $app->get('/delete/:id', function($id=0) use ($app, $con){

        $despesa = new Despesa($con);

        $mes = new Mes($con);

        $mes->deleteData($id);

        if($despesa->deleteData($id))
            $app->flash('message', 'Despesa deletada com sucesso');
        else
            $app->flash('error', 'Houve um erro ao tentar deletar os dados');

        $redirect = $app->urlFor('homeDespesas');

        $app->redirect($redirect);

    });

    $app->get('/delete/single/:id', function($id=0) use ($app, $con){

        $despesa = new Despesa($con);

        $despesa->deleteById($id);

    });

    $app->get('/reporter/:id', function($id=0) use ($app, $con){

        $despesa = new Despesa($con);

        $data['despesas'] = $despesa->selectById($id);

        $app->render('despesas/report.inc.php', $data);

    });

});

$app->run();
