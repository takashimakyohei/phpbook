<?php 
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  
  $_SESSION['time']=time();
  //

  $users = $db->prepare('select * from users where id=?');
  $users->execute(array($_SESSION['id']));
  $user = $users->fetch();
}else{
  header('Location: login.php');
  exit();
}

//投稿をデータベースに保存する
if(!empty($_POST)){
  if ($_POST['text']!=''){
    $text = $db->prepare('insert into posts(user_id,text) values (?,?)');
    $text->execute(array(
      $user['id'],
      $_POST['text']
    ));
    header('Location: index.php'); exit();
  }
}

// $posts = $db->query('select * from posts inner join users on posts.user_id = users.id;');
$posts = $db->query('select u.name,p.* from users u, posts p where p.user_id = u.id;');

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
<h2>practice</h2>
ようこそ、<?php echo htmlspecialchars($user['name'],ENT_QUOTES); ?>さん
<a href="logout.php">ログアウト</a>
<form action="" method="post">
  <p>何か投稿する</p>
  <input type="text" name="text">
  <input type="hidden" name="post_id">
  <input type="submit" value="投稿する">
</form>
</body>
</html>


<?php foreach ($posts as $post):?>
  <p><?php echo htmlspecialchars($post['text'], ENT_QUOTES);?>
  投稿者：<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>
  </p>
  <?php if ($_SESSION['id'] == $post['user_id']):?>
    <a href="delete.php?id=<?php echo htmlspecialchars($post['id'],ENT_QUOTES);?>">削除</a>
  <?php endif; ?>
<?php endforeach; ?>
