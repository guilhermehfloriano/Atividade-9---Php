<?php

include "../infra/conexao.php";

$id = intval($_POST["id"]);
$nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
$raca = mysqli_real_escape_string($conexao, $_POST["raca"]);
$especie = mysqli_real_escape_string($conexao, $_POST["especie"]);
$peso = mysqli_real_escape_string($conexao, $_POST["peso"]);
$idade = mysqli_real_escape_string($conexao, $_POST["idade"]);

$sql = "UPDATE animais SET nome='$nome',raca='$raca',idade='$idade' WHERE id = '$id'";

mysqli_query($conexao, $sql);
header("Location: ../index.php");