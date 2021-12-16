<?php
session_start();
if(empty($_POST["u_id"]) || empty($_POST["pass"])) {
    header("Location: signup.php?err=1");
}
if(empty($_SESSION["token"]) || empty($_POST["token"])) {
    header("Location: signup.php?err=2");
}
if($_SESSION["token"] != $_POST["token"]) {
    header("Location: signup.php?err=3");
}

require_once("config.php");
$hash = password_hash($_POST["pass"], PASSWORD_DEFAULT);
$sql = "INSERT INTO users(u_id, pass)";
$sql .= " VALUES(:u_id, :pass)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":u_id", $_POST["u_id"], PDO::PARAM_STR);
$stmt->bindValue("pass", $hash, PDO::PARAM_STR);
$stmt->execute();

session_regenerate_id();
$_SESSION["login"] = true;
header("Location: index.php");




?>