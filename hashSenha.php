<?php
session_start();

$usuarioCadastrado = "admin";
$hashSalva = password_hash("senha123", PASSWORD_DEFAULT);

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuarioDigitado = $_POST["usuario"] ?? "";
    $senhaDigitada   = $_POST["senha"]   ?? "";

    if ($usuarioDigitado === $usuarioCadastrado && password_verify($senhaDigitada, $hashSalva)) {
        $_SESSION["usuario"] = $usuarioDigitado;
        $_SESSION["logado"]  = true;
        $mensagem = "Login realizado com sucesso!";
    } else {
        $mensagem = "Usuário ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    <form method="POST" action="">
        <label>Usuário:</label><br>
        <input type="text" name="usuario"><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha"><br><br>

        <button type="submit">Entrar</button>
    </form>

    <?php if ($mensagem): ?>
        <p><?= $mensagem ?></p>
    <?php endif; ?>

    <hr>
    <p><strong>Usuario cadastrado: admin</strong></p>
    <p><strong>Hash gerada para "senha123":</strong><br><?= htmlspecialchars($hashSalva) ?></p>

</body>
</html>