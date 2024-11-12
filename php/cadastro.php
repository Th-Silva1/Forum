<?php 
require_once(dirname(__FILE__) . '/../endphp/Conexao.php');
include_once(dirname(__FILE__) . '/../endphp/validacao.php');
$sucesso = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    if (empty($erros)) {
        $sucesso = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/login2.css">
    <link rel="stylesheet" href="header.css">
    <title>Cadastro</title>
</head>
<body>

    <?php if (!empty($erros)): ?>
        <ul>
            <?php foreach ($erros as $erro): ?>
                <li style="color: red;"><?php echo $erro; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form class="login" action="" method="post" enctype="multipart/form-data">
        <p><?php echo ""?></p>
        <img src="../img/logoforum1 (sem fundo).png" alt="Logo">
        <input type="text" class="field" placeholder="Nome" name="nome">
        <input class="field" type="email" placeholder="E-mail" name="email">
        <input class="field" type="password" placeholder="Senha" name="senha">
        <input class="field" type="password" placeholder="Confirme a senha" name="confirmar_senha">
        <label class="image" for="image">Selecione a imagem de perfil</label>
        <input type="file" id="image" name="image" class="field" accept="image/jpg, image/jpeg, image/png">
        <input type="submit" value="Cadastrar">
        <label>Já possui conta? <a href="../index.php">Faça Login</a></label>
    </form>

    <?php if ($sucesso): ?>
        <p id="sucesso" style="color: green;">Cadastrado com sucesso! Redirecionando...</p>

        <script>
            setTimeout(function() {
                window.location.href = '../index.php';
            }, 3000);
        </script>
    <?php endif; ?>

    <script src="../js/header.js"></script>
</body>
</html>
