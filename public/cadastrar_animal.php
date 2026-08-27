<?php
session_start();
var_dump($_SESSION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../infra/conexao.php";

    $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    $raca = mysqli_real_escape_string($conexao, $_POST["raca"]);
    $especie = mysqli_real_escape_string($conexao, $_POST["especie"]);
    $peso = mysqli_real_escape_string($conexao, $_POST["peso"]);
    $idade = mysqli_real_escape_string($conexao, $_POST["idade"]);
    $usuario_id = $_SESSION['id'];

    if (empty($nome) || empty($raca) || empty($especie) || empty($peso) || empty($idade)) {
        $erro = "Todos os campos são obrigatórios!";
    } else if ($idade <= 0) {
        $erro = "A idade deve ser maior que zero!";
    } else {
        $sql = "INSERT INTO animais (nome, raca, especie, peso, idade, usuario_id) VALUES ('$nome', '$raca', '$especie', '$peso', '$idade', '$usuario_id')";

        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Animal cadastrado com sucesso!";
            header("Refresh: 2; url=../index.php");
        } else {
            $erro = "Erro ao cadastrar animal: " . mysqli_error($conexao);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Animal - CRUD PetShop</title>
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

            <h2> Adicionar Novo Animal</h2>

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
                    <label for="nome">Nome do Animal:</label>
                    <input 
                        type="text" 
                        id="nome"
                        name="nome" 
                        placeholder="Ex: Bob"

                        required
                        value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="raca">Raça:</label>
                    <input 
                        type="text" 
                        id="raca"
                        name="raca" 
                        placeholder="Ex: Labrador"
                        required
                        value="<?php echo isset($_POST['raca']) ? htmlspecialchars($_POST['raca']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="idade">Idade:</label>
                    <input 
                        type="number" 
                        id="idade"
                        name="idade" 
                        step="0.01"
                        min="0"
                        placeholder="0.00"
                        required
                        value="<?php echo isset($_POST['idade']) ? htmlspecialchars($_POST['idade']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="peso">Peso:</label>
                    <input 
                        type="number" 
                        id="peso"
                        name="peso" 
                        step="0.01"
                        min="0"
                        placeholder="0.00"
                        required
                        value="<?php echo isset($_POST['peso']) ? htmlspecialchars($_POST['peso']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="especie">Espécie:</label>
                    <input 
                        type="text" 
                        id="especie"
                        name="especie" 
                        placeholder="Ex: Cachorro"
                        required
                        value="<?php echo isset($_POST['especie']) ? htmlspecialchars($_POST['especie']) : '' ?>"
                    >
                </div>

                <div class="grupo-botoes">
                    <button type="submit" class="btn btn-sucesso">
                         Cadastrar Animal
                    </button>
                    <button onclick="window.location.href='../index.php'">
                         Cancelar
                    </button>
                </div>
            </form>
        </section>
    </main>

    
</body>

</html>