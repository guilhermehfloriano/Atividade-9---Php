<?php

include "../infra/conexao.php";

$id = $_POST["id"];
$nome = $_POST["nome"];
$raca = $_POST["raca"];
$idade = $_POST["idade"];

$sql = "UPDATE animais SET nome='$nome',raca='$raca',idade='$idade' WHERE id = '$id'";

mysqli_query($conexao, $sql);
header("Location: ../index.php");