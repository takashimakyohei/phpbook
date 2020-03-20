<?php 
require('dbconnect.php');
session_start();

if ($_COOKIE['email'] != '') {
  $_POST['email'] = $_COOKIE['email'];
  $_POST['password'] = $_COOKIE['password'];
  $_POST['save'] = 'on';
  }

  var_dump($_POST['email']);
  var_dump( $_POST['password']);
  var_dump ($_POST['save']);
//ログイン処理
if (!empty($_POST)){
  if ($_POST['email'] != '' && $_POST['password'] != ''){
    //prepareで仮の値を入れる
    $login = $db->prepare('select * from users where email=? and password=?');
    //データベースから、該当するemailとpasswordをselectする
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));
    $user=$login->fetch();

    if ($user){
      //ログイン成功
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['time'] = time();

      if ($_POST['save'] == 'on') {
				setcookie('email', $_POST['email'], time()+60*60*24*14);
				setcookie('password', $_POST['password'], time()+60*60*24*14);
				}

      header('Location: index.php');
      exit();
    }else{
      $error['login']='failed';
    }
  }
    else{
      $error['login']='blank';
    }
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
  <h1>ログイン</h1>
  <form action="" method="post">
    <p>email:<input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>" /></p>
    <?php if($error['login'] == 'blank'): ?>
    <p>メールアドレスとパスワード記入しろ</p>
    <?php endif; ?>
    <?php if ($error['login'] == 'failed'): ?>
    <p>ログイン失敗　正しく記入しろ</p>
    <?php endif; ?>
    <p>password:<input type="text" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>" /></p>


    <input type="submit" value="ログインする">
  </form>
</body>

</html>