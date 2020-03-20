<?php
require('dbconnect.php');
session_start();

if ($_COOKIE['email'] != '') {
$_POST['email'] = $_COOKIE['email'];
$_POST['password'] = $_COOKIE['password'];
$_POST['save'] = 'on';
}


if (!empty($_POST)) {
	// ログインの処理
	if ($_POST['email'] != '' && $_POST['password'] != '') {
		$login = $db->prepare('SELECT * FROM users WHERE email=? AND
			password=?');
			$login->execute(array(
				$_POST['email'],
				sha1($_POST['password'])
			));
			$user = $login->fetch();
			if ($user) {
				// ログイン成功
				$_SESSION['id'] = $user['id'];
				$_SESSION['time'] = time();

				// ログイン情報を記録する
				if ($_POST['save'] == 'on') {
				setcookie('email', $_POST['email'], time()+60*60*24*14);
				setcookie('password', $_POST['password'], time()+60*60*24*14);
				}

				header('Location: index.php'); exit();
			} else {
				$error['login'] = 'failed';
			}
		} else {
			$error['login'] = 'blank';
		}
  }
 
	?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>

	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div id="wrap">
		<div id="head">
			<h1>ログインする</h1>
		</div>
		<div id="content">
			<div id="lead">
				<p>メールアドレスとパスワードを記入してログインしてください。</p>
				<p>入会手続きがまだの方はこちらからどうぞ。</p>
				<p>&raquo;<a href="user-management.php">入会手続きをする</a></p>
			</div>
			<form action="" method="post">
				<dl>
					<dt>メールアドレス</dt>
					<dd>
            <input type="text" name="email"
             size="35" maxlength="255" value="<?php 
             if (isset($_POST['email'])){
             echo htmlspecialchars($_POST['email'],ENT_QUOTES);
             } ?>"/>
					</dd>
					<dt>パスワード</dt>
					<dd>
            <input type="password" name="password" size="35" maxlength="255" value="<?php 
            if (isset($_POST['password'])){
            echo htmlspecialchars($_POST['password'],ENT_QUOTES);
            }?>"/>
					</dd>
				
				</dl>
				<div><input type="submit" value="ログインする" /></div>
			</form>
		</div>

	</div>
</body>
</html>
