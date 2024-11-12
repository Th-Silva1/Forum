<?php 
    $erroLogin = [];

    if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        include_once('../endphp/Conexao.php');
        conectarBanco();

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM users WHERE email = ? and senha = ?";
        
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$email, $senha]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0 )  {
            
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: feed.php');
                
        } else {
            unset($_SESSION['email']);
            unset( $_SESSION['senha']);
            header('Location: ../index.php');
        }

     } else {
        $erroLogin[] = 'Email ou senha incorretos';
     }
 ?>