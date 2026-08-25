<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../infra/conexao.php";

    $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    $descricao = mysqli_real_escape_string($conexao, $_POST["descricao"]);
    $preco = mysqli_real_escape_string($conexao, $_POST["preco"]);
    $categoria = mysqli_real_escape_string($conexao, $_POST["categoria"]);

    // Validação básica
    if (empty($nome) || empty($descricao) || empty($preco) || empty($categoria)) {
        $erro = "Todos os campos são obrigatórios!";
    } else if ($preco <= 0) {
        $erro = "O preço deve ser maior que zero!";
    } else {
        $sql = "INSERT INTO pratos (nome, descricao, preco, categoria) VALUES ('$nome', '$descricao', '$preco', '$categoria')";

        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Prato cadastrado com sucesso!";
            header("Refresh: 2; url=../index.php");
        } else {
            $erro = "Erro ao cadastrar prato: " . mysqli_error($conexao);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Prato - CRUD Restaurante</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <header>
        <h1> CRUD - Restaurante</h1>
    </header>

    <main>
        <section class="formulario-container">
            <div class="voltar">
                <a href="../index.php">← Voltar</a>
            </div>

            <h2> Adicionar Novo Prato</h2>

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
                    <label for="nome">Nome do Prato:</label>
                    <input 
                        type="text" 
                        id="nome"
                        name="nome" 
                        placeholder="Ex: Feijoada Completa"
                        required
                        value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="descricao">Descrição:</label>
                    <textarea 
                        id="descricao"
                        name="descricao" 
                        placeholder="Descreva o prato, ingredientes, etc..."
                        rows="4"
                        required
                    ><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '' ?></textarea>
                </div>

                <div class="grupo-form">
                    <label for="preco">Preço (R$):</label>
                    <input 
                        type="number" 
                        id="preco"
                        name="preco" 
                        step="0.01"
                        min="0"
                        placeholder="0.00"
                        required
                        value="<?php echo isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : '' ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">-- Selecione uma categoria --</option>
                        <option value="entrada" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'entrada') ? 'selected' : '' ?>>Entrada</option>
                        <option value="prato_principal" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'prato_principal') ? 'selected' : '' ?>>Prato Principal</option>
                        <option value="sobremesa" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'sobremesa') ? 'selected' : '' ?>>Sobremesa</option>
                        <option value="bebida" <?php echo (isset($_POST['categoria']) && $_POST['categoria'] == 'bebida') ? 'selected' : '' ?>>Bebida</option>
                    </select>
                </div>

                <div class="grupo-botoes">
                    <button type="submit" class="btn btn-sucesso">
                         Cadastrar Prato
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