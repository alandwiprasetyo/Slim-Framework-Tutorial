<?php

include '../vendor/autoload.php';

// Database Connection
include 'database.php';

// Setting view folder
$app = new \Slim\Slim(array(
    'templates.path' => './view'
));
 

 // Default route
$app->get('/', function(){
    echo "Welcome to Slim";
}); 


// Using view 
$app->get('/test-page', function() use ($app) {
    $app->render('/test-page.php');
});

// Simple parameter
$app->get('/halo/:nama', function($nama){
	echo "Halo {$nama}";
});

//show semua
$app->get('/cities', function() use ($app){
	$app->response()->header('Content-Type','application/json;charset=utf-8');
	try{
		$db = getConnection();
		$sql = "select * FROM cities ORDER BY name";
		$stmt = $db->query($sql);
		$cities = $stmt ->fetchAll(PDO::FETCH_ASSOC);
		$db=null;
		echo '{"cities": '. json_encode($cities).'}';
	}catch(PDOException $e){
		echo '{"error":{"text":'.$e->getMessage().'}}';
	}
});

//get single show
 $app->get('/cities/:id', function($id) use ($app){
 	$app->response()->header('Content-Type', 'application/json;charset=utf-8');
 	$sql = "SELECT * FROM cities WHERE id=:id";
 	try{
 		$db = getConnection();
 		$stmt = $db->prepare($sql);
 		$stmt->bindParam("id",$id);
 		$stmt->execute();
 		$city = $stmt->fetchObject();
 		$db = null;
 		echo json_encode($city);

 	}catch(PDOException $e){
 		echo '{"error":{"text":'.$e->getMessage().'}}';
 	}
 });

//show single city
$app->get('/cities/:id', function($id) use ($app){
	include '../config.php';
	$header = array ('Accept' => 'application/json');
	$request = Requests::get($config['api_url'].'/cities/'.$id, $header);
	$city = json_decode($request->body);
	$baseURL = $app->request->getRootUri();
	$app->render('show.php',array('city'=>$city,'baseURL'=>$baseURL));

});


//delete
$app->delete('/cities/:id',function($id) use ($app){
 	$app->response()->header('Content-Type', 'application/json;charset=utf-8');
 	$sql = "DELETE FROM cities WHERE id=:id";
 	 	try{
 		$db = getConnection();
 		$stmt = $db->prepare($sql);
 		$stmt->bindParam("id",$id);
 		$stmt->execute();
 		$db = null;
 		echo json_encode(array('mesagge'=>"Delete City with id=$id succes"));

 	}catch(PDOException $e){
 		echo '{"error":{"text":'.$e->getMessage().'}}';
 	}

});

//edit
$app->put('/cities/:id', function($id) use ($app){
	$app->response()->header('Content-Type','application/json;charset=utf-8');
	$body = $app->request->getBody();
	$city = json_decode($body);
	$sql = "UPDATE cities set name=:name WHERE id=:id";
	try{
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name",$city->name);
		$stmt->bindParam("id",$id);
		$stmt->execute();
		$db=null;
		echo json_encode(array('mesagge'=>"Update city"));

	}catch(PDOException $e){
 		echo '{"error":{"text":'.$e->getMessage().'}}';
	}
});


 $app->post('/cities', function() use ($app){
 	$app->response()->header('Content-Type','application/json;charset=utf-8');
 	$request = $app->request();
 	$city = json_decode($request->getBody());
 	$sql = "INSERT INTO cities (name) VALUES (:name)";
 	try{
 	$db = getConnection();
 	$stmt = $db->prepare($sql);
 		$stmt->bindParam("name", $city->name);
 		$stmt->execute();
 		$city->id = $db->lastInsertId();
 		$db = null;
 		echo json_encode(array('mesagge'=>'Success create a new city','city'=>$city));
 	}catch(PDOException $e){
 		echo $e;
 	}
 });

$app->run();