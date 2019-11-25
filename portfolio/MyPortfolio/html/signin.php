<?php
//XSS対策('<'や'&'などのエスケープ処理)
function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'utf-8');
}
//セッション開始
  session_start();
//すでにログインしているユーザーの処理
if(isset($_SESSION['EMAIL'])){
  echo "ようこそ".h($_SESSION['EMAIL'])."さん<br>";
  echo "<a href='logout.php'>ログアウトする</a>";
  //プログラム終了
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>カフェ勉 for auwifi|ログイン</title>
  </head>
  <body>
    <ul>
      <li class="headlink"><a href="../index.php">トップページ</a></li>
    </ul>
    <h1>ログイン</h1>
    <form action="login.php" method="post">
      <label for="id">メールアドレス</label>
      <input type="text" name="email" value="">
      <label for="password">パスワード</label>
      <input type="text" name="password" value="">
      <input type="submit" value="ログイン">
    </form>
    <h1>初めての方</h1>
    <form action="signup.php" method="post">
      <label for="id">メールアドレス</label>
      <input type="text" name="email" value="">
      <label for="password">パスワード</label>
      <input type="text" name="password" value="">
      <label for="name">ニックネーム</label>
      <input type="text" name="name" value="">
      <input type="submit" value="新規登録">
    </form>
  </body>
</html>
