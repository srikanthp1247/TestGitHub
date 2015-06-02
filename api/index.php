<?php

require 'Slim/Slim.php';

$app = new Slim();
$app->post('/login_user', 'login');
$app->post('/ask_user', 'askQuestion');
$app->post('/add_user', 'addUser');
$app->get('/users', 'getUsers');
$app->get('/users/:id', 'getUser');
$app->put('/users/:id', 'updateUser');
$app->delete('/users/:id', 'deleteUser');
//$app->post('/ans_user', 'answerUser');


$app->run();

function getUsers() {

	//$sql = "Select * from user left join table_question on user.id = table_question.qid ";
	//$sql= "SELECT t1.name, t1.email FROM user as t1 LEFT JOIN table_question as t2 ON t1.id = t2.id  LEFT JOIN table_answer as t3 ON t1.id = t3.id and t3.id =t2.id";
//$sql="select name,email,category,title,question,solution from user U, table_question Q, table_answer A where Q.uid=U.uid and Q.qid=A.qid"; 	
//$sql = "select * FROM technical where question IS NOT NULL ORDER BY id";
$sql = "select * FROM technical ORDER BY id";


	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($wines);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getUser($id) {
	$sql = "select * FROM technical WHERE id=".$id." ORDER BY id";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($wines);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addUser() {
	$request = Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	$sql = "INSERT INTO technical (name, email, gender, password) VALUES (:name, :email, :gender, :password)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $user->name);
		$stmt->bindParam("email", $user->email);
		$stmt->bindParam("gender", $user->gender);
		$stmt->bindParam("password", $user->password);
		$stmt->execute();
		$user->id = $db->lastInsertId();
		$db = null;
		echo json_encode($user); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function askQuestion() {
	$request = Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	
	//$var="select uid from user where email= :email";
	$sql = "UPDATE technical SET category=:category,title=:title,question=:question WHERE email= 's@gmail.com'"; 
	
	
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
	
			
			$stmt->bindParam("email", $user->email);
		$stmt->bindParam("category", $user->category);
		$stmt->bindParam("title", $user->title);
		$stmt->bindParam("question", $user->question);
		
		$stmt->execute();
		$user->id = $db->lastInsertId();
		$db = null;
		echo json_encode($user); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


//-----------------------------------------------LOGIN-------------------------------------------------------------------
function login() 													
{
    $request = Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $email= $user->email;
    $password= $user->password;

if(!empty($email)&&!empty($password))
    {
        $sql="SELECT name, email FROM user WHERE email='$email' and password='$password'";
        $db = getConnection();
    try {
        $result=$db->query($sql); 

                if (!$result) { // add this check.
                      die('Invalid query: ' . mysql_error());
                }
        $row["user"]= $result->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($row);
	echo "Welcome";

    } catch(PDOException $e) 
    {
        error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
    }
}
//----------------------------------------------------------------------------------------------------------------------


function updateUser($id) {
	$request = Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	$sql = "UPDATE technical SET solution=:solution WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		
		$stmt->bindParam("solution", $user->solution);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($user); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


function deleteUser($id) {
	$sql = "DELETE FROM technical WHERE id=".$id;
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($wines);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="root";
	$dbpass="";
	$dbname="tech";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>
