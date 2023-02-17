<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

//$app = new \Slim\App;
$app->get('/',function(Request $request,Response $response){
    echo 'home user working';
});
$app->get('/api/users',function(Request $request,Response $response){
    $sql="SELECT * FROM users";
    try {
        $db= new db();
        $pdo=$db->connect();

        $stmt=$pdo->query($sql);
        $users=$stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo=null;
        echo json_encode($users);
        //var_dump($users);
        
        for($i=0;$i<count($users);$i++){
            $response->getBody()->write($users[$i]);
        }

    } catch (\PDOException $e) {
        echo'{"msg":{"resp": '. $e->getMessage() . '}}';
    }
});
$app->run();

/*
$app->post('/api/users/add', function(Request $request ,Response $reponse,array $args)){
    $first_name=$request->getParam('first_name');
    $last_name=$request->getParam('last_name');
    $phone=$request->getParam('phone');
    $email=$request->getParam('email');
    $address=$request->getParam('address');
    $city=$request->getParam('state');
    $state=$request->getParam('state');
    
    try{
        $db=new db();
        $pdo=$db->connect();
        $sql="INSERT INTO users(first_name,last_name,phone, email,address,city,state) VALUES (?,?,?,?,?,?,?)";
        $pdo->prepare($sql)->execute([$first_name,$last_name,$phone,$email,$address,$city,$state]);
        echo'{"notice":{"text":"user'.$first_name.'nhas been jsut added now"}}';
        $pdo=null;

    } catch (\PDOException $e){
        echp '{"error":{"text":'.$e->getMessage().'}}';

    }
}*/