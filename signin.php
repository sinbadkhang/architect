<?php
session_start();
  header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['username']) && isset($_POST['password']) ) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM account WHERE username='".$username."' and password='".$password."' ";
    $result = mysqli_query($conn, $sql);
    // if EXIST account 
    if($result){
      $_SESSION['login-status'] = 'ready';
      $_SESSION['name'] = $username;
      
      $data['result'] = true;
      $data['message'] = 'Sign In Successfully. Welcome Back '.$username;
      // if ADMIN ACCOUNT
      if($row = mysqli_fetch_assoc($result) ) {
        $json[] = $row;
        $_SESSION['state'] = $row['state'];
      }

      $data['account'] = $json;
    // if NOT MATCH
    }else{
      $data['result'] = false;
      $data['message'] = "Wrong Username Or Password";
    }
  }

  mysqli_close($conn);
  echo json_encode($data);
}
?>