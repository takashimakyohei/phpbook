<?php 
session_start();
require('dbconnect.php');

if (!empty($_POST)){
  //エラー項目の確認
  if($_POST['user'] == ''){
    $error['user'] = 'blank';
  }
  if($_POST['email'] == ''){
    $error['email'] = 'blank';
  }
  if(strlen($_POST['password']) < 7){
    $error['password'] = 'length';
  }
  if($_POST['password'] == ''){
    $error['password'] = 'blank';
  }
  if(empty($error)){
    $_SESSION['join'] = $_POST;
    header('Location: check.php');
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>会員登録</h1>
  <form action="" method="post">

  ユーザー名：<input type="text" name="name" 
  value="<?php 
  if (isset($_POST['name'])){
  echo htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8');
  }?>">
 

  e-mail: <input type="text" name="email" value="<?php 
  if (isset($_POST['email'])){
  echo htmlspecialchars($_POST['email'],ENT_QUOTES, 'UTF-8');
  } ?>"/>
  

  PW: <input type="text" name = password value="<?php 
  if (isset($_POST['password'])){
  echo htmlspecialchars($_POST['password'],ENT_QUOTES, 'UTF-8');
  } ?>" />
 
  
  <button type="submit">登録する</button>
  </form>
</body>
</html>