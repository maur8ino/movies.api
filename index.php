<?php

require_once 'Slim/Slim.php';
require_once 'ActiveRecord/ActiveRecord.php';

require_once 'templates/json.php';

ActiveRecord\Config::initialize(function($cfg)
{
	$cfg->set_model_directory('models/sakila');
	$cfg->set_connections(array(
		'development' => 'mysql://sakila:sakila123!@localhost/sakila'));
});


$app = new Slim(array('view' => 'JsonView'));

$app->get('/', function () {
});

$app->get('/films', function () use ($app) {
	$data['title'] = 'films';
	$data['object'] = Film::all(array('limit' => 10));
	$data['include_item_count'] = true;
	$app->render('json.php', $data); 
}); 

$app->get('/films/search/:title', function ($title) use ($app) {
	$title_decoded = urldecode($title);
	$data['title'] = 'films';
	$data['object'] = Film::all(array('conditions' => array("title LIKE CONCAT('%',?,'%')", $title_decoded)));
	$data['include_item_count'] = true;
	$app->render('json.php', $data); 
}); 

$app->get('/films/:id', function ($id) use ($app) {
	$data['object'] = Film::find($id);
	$app->render('json.php', $data); 
});

$app->run();