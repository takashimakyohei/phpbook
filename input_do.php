
<pre>
<?php 
    try{
      // new PDO = (データソース名、ユーザー名、パスワード、オプション)
       
       $db = new PDO('mysql:dbname=bss;host=localhost;charset=utf8','sima','0000');
       $statement = $db->prepare('insert into posts(user_id,text) values(?,?)');
       $statement->bindParam(1,$_POST['user_id']);
       $statement->bindParam(2,$_POST['text']);
       $statement->execute();
       
       echo '登録完了';


    } catch(PDOException $e){
      echo 'DB接続エラー :' . $e->getMessage();
    }
?>
</pre>