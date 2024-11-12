<?php 
    $erroLogin = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") { 
        
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
            include_once('endphp/Conexao.php');
            conectarBanco();

            $sql = "SELECT * FROM user_form WHERE email = ? and senha = ?";
            
            $stmt = $conexao->prepare($sql) or die('query failed');
            $stmt->execute([$email, $senha]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0 )  {
                
                $row = $result;
                $_SESSION['user_id'] = $row['id'];
                header('Location: php/feed.php');
                    
            } else {
                $erroLogin[] = 'Email ou senha invalidos.';
            }

        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                
                if (!$email) {
                    $erroLogin[] = "O campo email deve ser preenchido.";
                }

                if (!$senha) {
                    $erroLogin[] = "O campo senha deve ser preenchido.";
                }
            }
        }
    }
?>