<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../infra/conexao.php";

    $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    $email = mysqli_real_escape_string($conexao, $_POST["email"]);
    $telefone = mysqli_real_escape_string($conexao, $_POST["telefone"]);

    if (empty($nome) || empty($email) || empty($telefone)) {
        $erro = "Todos os campos são obrigatórios!";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Email inválido!";
    } else {
        $sql = "INSERT INTO usuarios (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";

        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Usuário cadastrado com sucesso!";
            header("Refresh: 2; url=../index.php");
        } else {
            if (strpos(mysqli_error($conexao), "Duplicate entry") !== false) {
                $erro = "Este email já está cadastrado!";
            } else {
                $erro = "Erro ao cadastrar usuário: " . mysqli_error($conexao);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário - CRUD PetShop</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <header>
        <h1> CRUD - PetShop</h1>
    </header>

    <main>
        <section class="formulario-container">
            <div class="voltar">
                <button onclick="window.location.href='../index.php'">←Voltar</button>
            </div>

            <h2> Cadastrar Novo Usuário</h2>

            <?php if (isset($erro)) { ?>
                <div class="alerta alerta-erro">
                     <?php echo $erro ?>
                </div>
            <?php } ?>

            <?php if (isset($sucesso)) { ?>
                <div class="alerta alerta-sucesso">
                     <?php echo $sucesso ?><br>
                    <small>Redirecionando...</small>
                </div>
            <?php } ?>

            <form method="POST" class="formulario">
                <div class="grupo-form">
                    <label for="nomeUsuario">Nome Completo:</label>
                    <input 
                        type="text" 
                        id="nomeUsuario"
                        name="nomeUsuario" 
                        placeholder="Digite seu nome completo"
                        required
                        value="<?php echo isset($_POST['nomeUsuario']) ? htmlspecialchars($_POST['nomeUsuario']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="emailUsuario">Email:</label>
                    <input 
                        type="email" 
                        id="emailUsuario"
                        name="emailUsuario" 
                        placeholder="seu.email@exemplo.com"
                        required
                        value="<?php echo isset($_POST['emailUsuario']) ? htmlspecialchars($_POST['emailUsuario']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="telefoneUsuario">Telefone:</label>
                    <input 
                        type="text" 
                        id="telefoneUsuario"
                        name="telefoneUsuario" 
                        placeholder="(XX) XXXXX-XXXX"
                        required
                        value="<?php echo isset($_POST['telefoneUsuario']) ? htmlspecialchars($_POST['telefoneUsuario']) : '' ?>"
                    >


                <div class="grupo-botoes">
                    <button type="submit" class="btn btn-sucesso">
                         Cadastrar Usuário
                    </button>
                    <a href="../index.php" class="btn btn-cancelar">
                         Cancelar
                    </a>
                </div>
            </form>
        </section>
    </main>


</body>

</html>