<?php

include '../vendor/autoload.php';

// Setting view folder
$app = new \Slim\Slim(array(
    'templates.path' => './view'
));
 

 // Default route
$app->get('/', function(){
    echo "Welcome to Slim";
}); 

$app->get('/cities',function() use ($app){
	include '../config.php';
	$header = array('Accept' => 'application/json');
	$request = Requests::get($config['api_url'].'/cities', $header);
	$jsonData = json_decode($request->body);
	$baseURL = $app->request->getRootUri();
	$app->render('cities.php',array('cities'=>$jsonData->cities, 'baseURL'=>$baseURL));	 
});

//show single
$app->get('/cities/:id',function($id) use ($app){
	include '../config.php';
	$header = array('Accept' => 'application/json');
	$request = Requests::get($config['api_url'].'/cities/'.$id, $header);
	$city = json_decode($request->body);
	$baseURL = $app->request->getRootUri();
	$app->render('single.php',array('city'=>$city,'baseURL'=>$baseURL));
});


//delete single
$app->get('/cities/:id/delete',function($id) use ($app){
	include '../config.php';
	$header = array('Accept' => 'application/json');
	$request = Requests::delete($config['api_url'].'/cities/'.$id, $header);

	$request = Requests::get($config['api_url'].'/cities', $header);
	$jsonData = json_decode($request->body);
	$baseURL = $app->request->getRootUri();
	$app->render('cities.php',array('cities'=>$jsonData->cities, 'baseURL'=>$baseURL));	 

});





//edit
$app->get('/cities/:id/edit', function($id) use ($app){
	include '../config.php';
	$header = array('Accept' =>'application/json');
	$request = Requests::get($config['api_url'].'/cities/'.$id , $header);
	$city = json_decode($request->body);
	$baseURL = $app->request->getRootUri();
	$app->render('edit.php',array('city'=>$city, 'baseURL'=>$baseURL));
});

//single edit
$app->post('/cities/:id/update', function($id) use ($app){
	include '../config.php';
	$header = array('Content-Type' =>'application/json');
	$data['name'] = $_POST['name'];
	$data['id'] = $id;
	$request = Requests::put($config['api_url'].'/cities/'.$id, $header, json_encode($data));
	echo $request->body;
});


//new single
$app->get('/cities/',function() use ($app){
		include '../config.php';
	$baseURL = $app->request->getRootUri();
	$app->render('new.php',array('baseURL'=>$baseURL));	 
});
//new single
$app->post('/cities/',function() use ($app){
		include '../config.php';
		$header = array('Content-Type' => 'application/json');
		$data['name'] = $_POST['name'];
		$request = Requests::post($config['api_url'].'/cities', $header,json_encode($data));
		echo $request->body;
});

$app->run();