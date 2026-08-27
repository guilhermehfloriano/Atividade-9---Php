
<?php

include "../infra/conexao.php";

$id = intval($_GET["id"]);
$animal = mysqli_query($conexao, "SELECT * FROM animais WHERE id = $id");
$animal_dados = mysqli_fetch_assoc($animal);

$usuariosResult = mysqli_query($conexao, "SELECT id, nome FROM usuarios ORDER BY nome");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    $raca = mysqli_real_escape_string($conexao, $_POST["raca"]);
    $idade = mysqli_real_escape_string($conexao, $_POST["idade"]);
    $usuario_id = mysqli_real_escape_string($conexao, $_POST["usuario_id"]);

    if (empty($nome) || empty($raca) || empty($idade) || empty($usuario_id)) {
        $erro = "Todos os campos são obrigatórios!";
    } else if ($idade <= 0) {
        $erro = "A idade deve ser maior que zero!";
    } else {
        $sql = "UPDATE animais SET nome='$nome', raca='$raca', idade='$idade', usuario_id='$usuario_id' WHERE id=$id";

        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Animal atualizado com sucesso!";
            header("Refresh: 2; url=../index.php");
        } else {
            $erro = "Erro ao atualizar animal: " . mysqli_error($conexao);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal - CRUD PetShop</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <header>
        <h1> CRUD - PetShop</h1>
    </header>

    <main>
        <section class="formulario-container">
            <div class="voltar">
                <a href="../index.php">← Voltar</a>
            </div>

            <h2> Editar Animal</h2>

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
                        required
                        value="<?php echo htmlspecialchars($prato_dados["nome"]) ?>"
                    >
                </div>

                <div class="grupo-form">
                    <label for="raca">Raça:</label>
                    <input 
                        type="text" 
                        id="raca"
                        name="raca" 
                        required
                        value="<?php echo htmlspecialchars($prato_dados["raca"]) ?>"
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
                        required
                        value="<?php echo htmlspecialchars($prato_dados["idade"]) ?>"
                    >
                </div>


                <div class="grupo-form">
                    <label for="usuario_id"> Responsável pelo Animal:</label>
                    <select id="usuario_id" name="usuario_id" required>
                        <option value="">-- Selecione um usuário --</option>
                        <?php 
                        if (mysqli_num_rows($usuariosResult) > 0) {
                            while ($usuario = mysqli_fetch_assoc($usuariosResult)) {
                                $selected = ($animal_dados['usuario_id'] == $usuario['id']) ? 'selected' : '';
                                echo "<option value='{$usuario['id']}' $selected>{$usuario['nomeUsuario']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>Nenhum usuário cadastrado</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="grupo-botoes">
                    <button type="submit" class="btn btn-sucesso">
                         Atualizar animal
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