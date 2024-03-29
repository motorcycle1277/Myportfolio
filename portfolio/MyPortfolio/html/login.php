<?php
ini_set('display_errors', 1);
require_once('config.php');

session_start();
//emailアドレスを受けとった際にフィルタリングを行う処理(メールアドレスの形になっているか？)
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  echo '入力された値が不正です。<br>';
  echo '<a href="signin.php">ログインページに戻る</a>';
  return false;
}
//DB内でPOSTされたメールアドレスを検索
try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $stmt = $pdo->prepare('select * from user where email = ?');
  $stmt->execute([$_POST['email']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(Exeption $e){
  echo $e->getMessage() . PHP_EOL;
}
//emailがDB内にあるかを確認
if(!isset($row['email'])){
  echo 'メールアドレス又はパスワードが間違っています。<br>';
  echo '<a href="signin.php">ログインページに戻る</a>';
  return false;
}
//パスワード確認後sessionにメールアドレスを渡す
if (password_verify($_POST['password'], $row['password'])) {
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['EMAIL'] = $row['email'];
  echo 'ログインしました<br>';
  echo '<a href="../index.php">トップページに戻る</a>';
} else {
  echo 'メールアドレス又はパスワードが間違っています。<br>';
  echo '<a href="signin.php">ログインページに戻る</a>';
  return false;
}
