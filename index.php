<h2>practice</h2>
<pre>
<?php
  try{
    // new PDO = (データソース名、ユーザー名、パスワード、オプション)

     $db = new PDO('mysql:dbname=bss;host=localhost;charset=utf8','sima','0000');
  } catch(PDOException $e){
    echo 'DB接続エラー :' . $e->getMessage();
  }

  // $query = $db->exec('insert into users(name,email,password) values("sima","test@au.co.jp","0000");');
  // echo $query . '件のデータを挿入しました';
  $records =$db->query('select * from users;');
  while($record = $records->fetch()){
    print ($record['email'] . "\n");
    print ($record['name'] . "\n");
  }

  
?>
</pre>