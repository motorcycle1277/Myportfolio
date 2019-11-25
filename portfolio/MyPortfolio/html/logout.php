<?php
 session_start();

 if(isset($_SESSION['EMAIL'])){
   echo 'ログアウトしました<br>';
   echo '<a href="signin.php">ログインページに戻る</a>';
 }else{
   echo 'タイムアウトしました<br>';
   echo '<a href="signin.php">ログインページに戻る</a>';
 }
 //セッション変数のクリア
 $_SESSION = array();
 //セッションクッキーの削除
 if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// 最終的に、セッションを破壊する
session_destroy();
