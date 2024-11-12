<?php 
$sucesso = false;
$erros = [];

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar_perfil'])) {
    $atualizar_nome = $_POST['atualizar_nome'];
    $atualizar_email = $_POST['atualizar_email'];

    $sql = "UPDATE user_form SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$atualizar_nome, $atualizar_email, $user_id]);

    $senha_antiga = $_POST['senha_antiga'];
    $atualizar_senha = $_POST['atualizar_senha'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if (!empty($atualizar_senha) || !empty($nova_senha) || !empty($confirmar_senha)) {
        if ($atualizar_senha != $senha_antiga) {
            $erros[] = 'Senha antiga não coincide';
        } elseif ($nova_senha != $confirmar_senha) {
            $erros[] = 'Confirmação de senha inválida';
        } else {
            $sql = "UPDATE user_form SET senha = ? WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$confirmar_senha, $user_id]);
        }
    }

    if (!empty($_FILES['atualizar_imagem']['name'])) {
        $atualizar_imagem = $_FILES['atualizar_imagem']['name'];
        $atualizar_imagem_tamanho = $_FILES['atualizar_imagem']['size'];
        $atualizar_tmp_nome = $_FILES['atualizar_imagem']['tmp_name'];

        $nome_unico_imagem = uniqid() . '_' . $atualizar_imagem;
        $pasta_imagem = '../profileimg/' . $nome_unico_imagem;

        if ($atualizar_imagem_tamanho > 10000000) {
            $erros[] = 'Tamanho da imagem é muito grande!';
        } else {
            $sql = "SELECT imagem FROM user_form WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$user_id]);
            $imagem_atual = $stmt->fetchColumn();

            if ($imagem_atual && file_exists('../profileimg/' . $imagem_atual)) {
                unlink('../profileimg/' . $imagem_atual);
            }

            $sql = "UPDATE user_form SET imagem = ? WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$nome_unico_imagem, $user_id]);

            if (move_uploaded_file($atualizar_tmp_nome, $pasta_imagem)) {
                $sucesso = true;
            } else {
                $erros[] = "Falha ao mover a imagem para o diretório.";
            }
        }
    }

    if (empty($erros)) {
        $sucesso = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

$sql = "SELECT * FROM user_form WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->execute([$user_id]);

if ($stmt->rowCount() > 0) {
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
} 
?>