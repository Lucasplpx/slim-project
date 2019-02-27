<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function($req, $res, $args){
    $lista = new Lista($this->db);
    $args['lista'] = $lista->getLista();
    return $this->renderer->render($res, 'home.phtml', $args);
});

$app->get('/add', function($req, $res, $args){
    $args['nome'] = 'Teste';
    return $this->renderer->render($res, 'add.phtml', $args);
});

$app->post('/add', function($req, $res, $args){
    $msg = array();

    $data = $req->getParsedBody();
    $lista = new Lista($this->db);
    $lista->add($data);
    
    return $res->withStatus(302)->withHeader("Location" , "/slim/public");
});

$app->get('/edit/{id}', function($req, $res, $args){
    $lista = new Lista($this->db);

    $args['info'] = $lista->getContato($args['id']);

    return $this->renderer->render($res, 'edit.phtml', $args);
});

$app->post('/edit/{id}', function($req, $res, $args){
    $data = $req->getParsedBody();
    $lista = new Lista($this->db);
    $lista->update($data, $args['id']);

    return $res->withStatus(302)->withHeader("Location" , "/slim/public");
});

$app->get('/del/{id}', function($req, $res, $args) {
    $lista = new Lista($this->db);
    $lista->del($args['id']);
    return $res->withStatus(302)->withHeader("Location" , "/slim/public");
});