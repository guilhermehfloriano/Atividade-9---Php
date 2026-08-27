<?php
include "../infra/conexao.php";
$id = intval($_GET["id"]);
$sql = "DELETE FROM animais WHERE id=$id";
mysqli_query($conexao, $sql);
header("Location: ../index.php");
?>