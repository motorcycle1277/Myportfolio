<?php
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
/*一旦削除//登録済みのEメールアドレスかどうかの確認処理
try {
    $stmt = $pdo->prepare("select count(*) from user where email=?");
    $count = $stmt->execute([$email]);
    foreach((array)$count as $row){
    if($row=="1"){
      throw new Exception();
    }
  }
} catch (Exception $e) {
  echo $email;
  echo $row;
  echo '登録済みのメールアドレスです。<br>';
  echo '<a href="signin.php">ログイン画面に戻る</a>';
  return false;
}*/
//登録処理
try{
  $stmt = $pdo->prepare("insert into user(email,password) value(?,?)");
  $stmt->execute([$email,$password]);
  echo '登録完了<br>';
  echo '<a href="signin.php">ログイン画面に戻る</a>';
}catch(Exception $e){
  echo '登録済みのメールアドレスです。<br>';
  echo '<a href="signin.php">ログイン画面に戻る</a>';
}
