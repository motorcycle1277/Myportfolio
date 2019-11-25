<?php
//セッション開始
session_start();
//セッションがなかった場合インデックスページにリダイレクト
if(!isset($_SESSION['EMAIL'])){
  header( "Location: ./index.php" ) ;
	exit ;
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>カフェ勉 for auwifi|会員情報変更</title>
  </head>
  <body>
    <ul>
      <li class="headlink"><a href="logout.php">ログアウト</a></li>
      <li class="headlink"><a href="../index.php">トップページ</a></li>
    </ul>
    <h1>会員情報変更</h1>
    <form action="change-output.php" method="post">
      <label for="id">メールアドレス</label>
      <input type="text" name="email" value="">
      <label for="password">パスワード</label>
      <input type="text" name="password" value="">
      <input type="submit" value="送信">
    </form>
  </body>
</html>
