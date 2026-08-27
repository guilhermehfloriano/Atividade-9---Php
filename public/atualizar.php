<?php

include "../infra/conexao.php";

$id = $_POST["id"];
$nome = $_POST["nome"];
$raca = $_POST["raca"];
$especie = $_POST["especie"];
$peso = $_POST["peso"];
$idade = $_POST["idade"];

$sql = "UPDATE animais SET nome='$nome',raca='$raca',especie='$especie',peso='$peso',idade='$idade' WHERE id = '$id'";

mysqli_query($conexao, $sql);
header("Location: ../index.php");