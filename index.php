<?php 
session_start();
include_once("endphp/login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login2.css">
    <title>Login</title>
</head>
<body>
    <?php if (!empty($erroLogin)): ?>
        <ul>
            <?php foreach ($erroLogin as $erro): ?>
                <li style="color: red;"><?php echo $erro; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form class="login" action="" method="post">
        <img src="img/logoforum1 (sem fundo).png" alt="Logo">
        <input class="field" type="email" placeholder="E-mail" name="email">
        <input class="field" type="password" placeholder="Senha" name="senha">
        <input type="submit" value="Entrar" name="submit">
        <label>Ainda não possui conta? <a href="php/cadastro.php">Cadastrar-se</a></label>
    </form>
</body>
</html>