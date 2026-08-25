<?php

include "../infra/conexao.php";

$id = $_POST["id"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$sql = "UPDATE animais SET nome='$nome',descricao='$descricao',preco='$preco',categoria='$categoria' WHERE id = '$id'";

mysqli_query($conexao, $sql);
header("Location: ../index.php");