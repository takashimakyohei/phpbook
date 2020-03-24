<?php 
session_start();
require('dbconnect.php');

if (!empty($_POST)){
  //エラー項目の確認
  if($_POST['user'] == ''){
    echo '<p>';
    echo 'ユーザー名が空です';
    echo '</p>';
    $error['user'] = 'blank';
  }
  if($_POST['email'] == ''){
    echo '<p>';
    echo 'メールアドレスが空です';
    echo '</p>';
    $error['email'] = 'blank';
  }
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false ){
    echo '<p>';
    echo 'メールアドレスが不正です';
    echo '</p>';
    $error['email'] = 'blank';
  }
  if(strlen($_POST['password']) < 7){
    echo '<p>';
    echo 'パスワードは7文字以上で入力してください';
    echo '</p>';
    $error['password'] = 'length';
  }
  if($_POST['password'] == ''){
    echo '<p>';
    echo 'パスワードが不正です';
    echo '</p>';
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

  ユーザー名：<input type="text" name="user" 
  value="<?php 
  if (isset($_POST['user'])){
  echo htmlspecialchars($_POST['user'],ENT_QUOTES, 'UTF-8');
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