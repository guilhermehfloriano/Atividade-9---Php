<?php

include "infra/conexao.php";
$animais = mysqli_query($conexao, "SELECT * FROM animais");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PetShop</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <header>
        <h1>CRUD - PetShop</h1>
    </header>



     <main>
        <section class="botoes-navegacao">
            <h2>O que você deseja fazer?</h2>
            <div class="container-botoes">
                <a href="public/cadastrar.php" class="btn btn-usuario">
                    Cadastrar Usuário
                </a>
                <a href="public/cadastrar_animal.php" class="btn btn-animal">
                    Cadastrar animal
                </a>
            </div>
        </section>
 
        <section class="animais-cadastrados">
            <h2>Animais Cadastrados</h2>
               <?php if (mysqli_num_rows($animais) > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Raça</th>
                            <th>Idade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($animal = mysqli_fetch_assoc($animais)) { ?>
                            <tr>
                                <td><?php echo $animal["id"] ?></td>
                                <td><?php echo $animal["nome"] ?></td>
                                <td><?php echo $animal["raca"] ?></td>
                                <td><?php echo $animal["idade"] ?></td>
                                <td><?php echo ucfirst(str_replace('_', ' ', $animal["raca"])) ?></td>
                                <td class="acoes">
                                    <a href="public/editar.php?id=<?php echo $animal["id"] ?>" class="btn-editar">Editar</a>
                                    <a href="public/excluir.php?id=<?php echo $animal["id"] ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p class="vazio">Nenhum animal cadastrado ainda.</p>
            <?php } ?>
        </section>
 
    </main>

 
</body>
 
</html>
 