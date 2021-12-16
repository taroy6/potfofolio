<?php
/*
ini_set("display_errors", 1);
error_reporting(E_ALL);
*/

session_start();
if(empty($_POST["u_id"]) || empty($_POST["pass"])) {
    header("Location: login.php?err=1");
    exit();
} 
if(empty($_SESSION["token"]) || empty($_POST["token"])) {
    header("Location: login.php?err=2");
    exit();
}
if($_SESSION["token"] != $_POST["token"]) {
    header("Location: login.php?err=3");
    exit();
}

require_once(dirname(__FILE__) . "/config.php");
$sql = "SELECT * FROM users";
$sql .= " WHERE u_id=:u_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":u_id", $_POST["u_id"], PDO::PARAM_STR);

$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$flag = password_verify($_POST["pass"], $row["pass"]);
if ($flag) {
    session_regenerate_id();
    $_SESSION["login"] = true;
    $_SESSION["u_id"] = $row["u_id"]; 
    header("Location: index.php");
} else {
        $_SESSION["login"] = false;
        header("Location: login.php?err=4");
}






?>