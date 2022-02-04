<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

require_once('funcs.php');
loginCheck();
// $_SESSION['kanri_flg'] = $val['kanri_flg'];

$_sessionid = $_SESSION['kanri_flg'];
// var_dump($_sessionid);

//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php
            if ($_sessionid == 1) {
                echo "<a href= select.php>"."データ一覧"."</a>";
            } else {
                echo "<a  href= selectreadonly.php>"."データ一覧"."</a>";
            }
            ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
        </div>
    </div>
</nav>