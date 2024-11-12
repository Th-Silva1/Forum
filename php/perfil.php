<?php 
include_once("../endphp/Conexao.php");
session_start();
include_once("../endphp/editarperfil.php");    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Cadastro</title>
</head>
<body>

    <header id="header">
        <div class="container-header">
            <div class="flex header-ul">
                <nav>
                    <ul class="primary-navigation">
                        <img src="../img/logoforum2.png" alt="Logo">
                        <div class="options">
                            <li><a href="Feed.php">Home</a></li>
                            <li>
                                <div class="action" onclick="actionToggle();">
                                    <span><?php echo htmlspecialchars($fetch['nome'])?></span>
                                    <ul>
                                        <li><a href="perfil.php">Editar perfil</a></li>
                                        <li><a href="">Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        </div>
                    </ul>
                </nav>
            </div>    
        </div>
    </header>
    
    <?php if (!empty($erros)): ?>
        <ul class="error">
            <?php foreach ($erros as $erro): ?>
                <li style="color: red;"><?php echo $erro; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php
        $sql = "SELECT * FROM user_form WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$user_id]);
        
        if ($stmt->rowCount() > 0) {
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>

    <div class="central">
        <form class="loginform" style="margin-top: 120px;" action="" method="post" enctype="multipart/form-data">
            <?php 
                if($fetch['imagem'] == '') {
                    echo '<img src="../img/default-avatar.png">';
                } else {
                    echo '<img src="../profileimg/' . $fetch['imagem'] . '">';
                }
            ?>
            <div class="quadrado1">
                <div class="quadrado2">
                    <span>Nome de usuário :</span>
                    <input type="text" class="field"  name="atualizar_nome" value="<?php echo $fetch['nome']; ?>">
                    <span>Seu email :</span>
                    <input class="field" type="email" name="atualizar_email" value="<?php echo $fetch['email']; ?>">
                    <span>Atualize sua foto :</span>
                    <label for="atualizar_imagem">Atualizar Foto</label>
                    <input type="file" name="atualizar_imagem" id="atualizar_imagem" accept="image/jpg, image/jpeg, image/png">
                </div>
                <div class="quadrado2">
                    <input type="hidden" name="senha_antiga" value="<?php echo $fetch['senha']; ?>">
                    <span>Senha atual :</span>
                    <input type="password" class="field" placeholder="Insira a senha atual" name="atualizar_senha">
                    <span>Nova senha :</span>
                    <input class="field" type="password" placeholder="Insira a nova senha" name="nova_senha">
                    <span>Confirme a senha :</span>
                    <input class="field" type="password" placeholder="Confirme a senha" name="confirmar_senha">
                </div>
            </div>
                <input type="submit" name="atualizar_perfil" value="atualizar perfil">
            <!-- <label>Já possui conta? <a href="../index.php">Faça Login</a></label> -->
        </form>
        <?php if ($sucesso): ?>
            <p id="sucesso" style="color: green;">Perfil atualizado com sucesso.</p>
            <?php endif; ?>
    </div>
    <script src="../js/header.js"></script>
</body>
</html>
