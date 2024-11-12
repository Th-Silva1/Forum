<?php
include_once("../endphp/Conexao.php");
conectarBanco();
session_start();

$user_id = $_SESSION["user_id"];

if (!isset($user_id)) {
    header('location: index.php');
}

$sql = "SELECT * FROM user_form WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->execute([$user_id]);

if ($stmt->rowCount() > 0) {
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
}     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/feed.css">
    <title>Página Principal</title>
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

    <main>
        <div class="m"> 
            <form action="" method="post" class="form">
                <div class="post">
                    <div class="perfil">
                        <?php 
                             if($fetch['imagem'] == '') {
                                 echo '<img src="../img/default-avatar.png">';
                             } else {
                                 echo '<img src="../profileimg/' . $fetch['imagem'] . '">';
                             }
                        ?>
                        <span><?php echo htmlspecialchars($fetch['nome']) ?></span>
                    </div>
                    <textarea name="content" id="" placeholder="Escreva algo..." required class="area"></textarea>
                </div>
                <hr style="width: 100%;">
                <div class="button">
                    <button type="submit" class="a">Enviar</button>
                </div>
            </form>
            <hr class="sep">
            <div class="form">
                <div class="post">
                    <div class="perfil">
                        <?php 
                             if($fetch['imagem'] == '') {
                                 echo '<img src="../img/default-avatar.png">';
                             } else {
                                 echo '<img src="../profileimg/' . $fetch['imagem'] . '">';
                             }
                        ?>
                        <span>NOMES</span>
                    </div>
                    <p class="area">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam aperiam corrupti deleniti tenetur quod itaque in dolore, ipsa eligendi accusantium ex quos illo porro atque, quia possimus nobis quo facere. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste voluptas quasi suscipit dolore eaque distinctio, nam laborum itaque similique recusandae assumenda alias enim odit eum aperiam dolores incidunt quam consequatur?</p>
                </div>
                <hr style="width: 100%;">
                <div class="button">
                    <span class="a">Like</span>
                </div>
            </div>
            <hr class="sep">
            <div class="form">
                <div class="post">
                    <div class="perfil">
                        <?php 
                             if($fetch['imagem'] == '') {
                                 echo '<img src="../img/default-avatar.png">';
                             } else {
                                 echo '<img src="../profileimg/' . $fetch['imagem'] . '">';
                             }
                        ?>
                        <span>NOMES</span>
                    </div>
                    <p class="area">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam aperiam corrupti deleniti tenetur quod itaque in dolore, ipsa eligendi accusantium ex quos illo porro atque, quia possimus nobis quo facere. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste voluptas quasi suscipit dolore eaque distinctio, nam laborum itaque similique recusandae assumenda alias enim odit eum aperiam dolores incidunt quam consequatur?</p>
                </div>
                <hr style="width: 100%;">
                <div class="button">
                    <span class="a">Like</span>
                </div>
            </div>
            <hr class="sep">
            <div class="form">
                <div class="post">
                    <div class="perfil">
                        <?php 
                             if($fetch['imagem'] == '') {
                                 echo '<img src="../img/default-avatar.png">';
                             } else {
                                 echo '<img src="../profileimg/' . $fetch['imagem'] . '">';
                             }
                        ?>
                        <span>NOMES</span>
                    </div>
                    <p class="area">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam aperiam corrupti deleniti tenetur quod itaque in dolore, ipsa eligendi accusantium ex quos illo porro atque, quia possimus nobis quo facere. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste voluptas quasi suscipit dolore eaque distinctio, nam laborum itaque similique recusandae assumenda alias enim odit eum aperiam dolores incidunt quam consequatur?</p>
                </div>
                <hr style="width: 100%;">
                <div class="button">
                    <span class="a">Like</span>
                </div>
            </div>
            <hr class="sep">
    </main>

    <script src="../js/header.js"></script>
</body>
</html>
