<?php
ini_set('display_errors', 1);
session_start();
require_once('config.php');
//データベースへ接続
try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
  echo $e->getMessage().PHP_EOL;
}
/*POST通信の検証*/
//受けとったメールアドレスをメールアドレスの形になっているかを
if(!$email= filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  echo '入力された値が不正です';
  return false;
}
//パスワードの正規表現
if(preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/', $_POST['password'])){
  //パスワードのハッシュ化
  $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
}else{
  echo 'パスワードは半角英小文字大文字数字をそれぞれ1種類以上含む8文字以上で設定してください。';
  return false;
}
//登録処理
  $prevemail = $_SESSION['EMAIL'];
  $stmt = $pdo->prepare("update user set email = ?,password = ? where email = ?");
  $stmt->execute([$_REQUEST['email'],$password,$prevemail]);
  //セッション変数の破棄
  $_SESSION = array();
  //セッションクッキーの削除
  if (isset($_COOKIE[session_name()])) {
     setcookie(session_name(), '', time()-42000, '/');
 }
 // 最終的に、セッションを破壊する
 session_destroy();
  echo '登録完了<br>';
  echo '<a href="../index.php">トップに戻る</a>';
