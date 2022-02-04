<?php
// 0. SESSION開始！！
session_start();
// 1. ログインチェック処理！
// 以下、セッションID持ってたら、ok
// 持ってなければ、閲覧できない処理にする。

// if ($_SESSION['chk_ssid'] != session_id()) {
//     exit('LOGIN ERROR');
// } else {
//     // 問題ない場合
//     session_regenerate_id(true);
//     $_SESSION['chk_ssid'] = session_id();
// }

//１．関数群の読み込み
require_once('funcs.php');
loginCheck();//funcs.phpを読み込まないとダメ

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<table>';
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $r["id"] . '">';
        $view .= '<td>'.h($r['id']) . '</td>'. '<td>'. h($r['booktitle']) . '</td>'. '<td>' . h($r['address']). '</td>' .'<td>' . h($r['memo'] ). '</td>';
        $view .= '</a>';
        $view .= "　";
        $view .= '</a>';
        $view .= '</p>';
        $view .= '</table>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
    
        <div class="container jumbotron">
            <table>
                    <tr>
                        <th>ID</th>
                        <th>タイトル</th>
                        <th>アドレス</th>
                        <th>メモ</th>
                    </tr>
            </table>    
                <?= $view ?>
        </div>
    </div>
    <!-- Main[End] -->

</body>

</html>