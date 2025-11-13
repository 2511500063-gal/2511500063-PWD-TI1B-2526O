<?php
session_start();
$_SESSION["nim"] = $_POST["nim"] ?? "";
$_SESSION["nama"] = $_POST["nama"] ?? "";
$_SESSION["tempat"] = $_POST["tempat"] ?? "";
$_SESSION["tanggal"] = $_POST["tanggal"] ?? "";
$_SESSION["hobi"] = $_POST["hobi"] ?? "";
$_SESSION["pasangan"] = $_POST["pasangan"] ?? "";
$_SESSION["pekerjaan"] = $_POST["pekerjaan"] ?? "";
$_SESSION["ortu"] = $_POST["ortu"] ?? "";
$_SESSION["kakak"] = $_POST["kakak"] ?? "";
$_SESSION["adik"] = $_POST["adik"] ?? "";

header("location: index.php");
exit();
?>