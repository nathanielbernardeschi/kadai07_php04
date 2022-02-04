<?php
//1. POSTデータ取得
$booktitle = $_POST['booktitle'];
$address = $_POST['address'];
$memo = $_POST['memo'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_bm_table(booktitle,address,memo,indate)VALUES(:booktitle,:address,:memo,sysdate());');
$stmt->bindValue(':booktitle', $booktitle, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
