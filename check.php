<?php 
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])){
  header('Location: user-management.php');
  exit();
}

if (!empty($_POST)){
  //登録処理をする
  $statement = $db->prepare('insert into users(name,email,password) values(?,?,?)');
  echo $ret = $statement->execute(array
  ($_SESSION['join']['user'],
  $_SESSION['join']['email'],
  sha1($_SESSION['join']['password'])
  ));
  unset($_SESSION['join']);
  header('Location: thanks.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
  <input type="hidden" name="action" value="submit" />
  <p>ユーザー名</p>
  <?php echo htmlspecialchars($_SESSION['join']['user'],ENT_QUOTES,'UTF-8'); ?>

  <p>メールアドレス</p>
  <?php echo htmlspecialchars($_SESSION['join']['email'],ENT_QUOTES,'UTF-8'); ?>

  <p>パスワード（表示されません）</p>

  <div>
    <a href="user-management.php?action=rewrite">&laquo;&nbsp;書き直す</a> |
    <input type="submit" value="登録する">
  </div>
  </form>
</body>

</html>