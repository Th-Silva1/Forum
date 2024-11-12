<?php 
$erros = [];
$sucesso = false;
include_once('Conexao.php');
$conexao = conectarBanco();

function limparDados($dado) {
    return htmlspecialchars(stripslashes(trim($dado)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = limparDados($_POST['nome']);
    $email = limparDados($_POST['email']);
    $senha = limparDados($_POST['senha']);
    $confirmar_senha = limparDados($_POST['confirmar_senha']);
    $imagem = $_FILES['image']['name'];
    $imagem_tmp_nome = $_FILES['image']['tmp_name'];
    $imagem_tamanho = $_FILES['image']['size'];
    $image_folder = "../profileimg/" . basename($imagem);

    // Verificação se o usuário já existe
    $sql = "SELECT COUNT(*) FROM user_form WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$email]);
    $userExist = $stmt->fetchColumn();

    if ($userExist > 0) {
        $erros[] = 'Email já cadastrado!';
    } else {
        if (!$senha || strlen($senha) < 6) {
            $erros[] = "A senha é obrigatória e deve ter pelo menos 6 caracteres!";
        } elseif ($senha !== $confirmar_senha) {
            $erros[] = "As senhas não coincidem!";
        } elseif ($imagem_tamanho > 10000000) {
            $erros[] = "O tamanho da imagem é muito grande!";
        } else {
            // Insere o usuário no banco de dados
            $sql = "INSERT INTO user_form (nome, email, senha, imagem) VALUES (?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $insert = $stmt->execute([$nome, $email, $senha, $imagem]);

            if ($insert) {
                move_uploaded_file($imagem_tmp_nome, $image_folder);
                $sucesso = true;
            } else {
                $erros[] = 'Falha ao registrar';
            }
        }
    }
}
?>
