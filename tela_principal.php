<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'leitor') {
    header('Location: login_leitor.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Leitor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            color: #fff;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: min(720px, 90%);
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }
        h1 { margin-top: 0; }
        .menu {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }
        .menu a, .logout {
            display: inline-block;
            padding: 12px 16px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
        }
        .logout {
            background: #7f1d1d;
            border: none;
            cursor: pointer;
        }
        .info {
            margin-top: 10px;
            color: #cbd5e1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
        <div class="info">Você está na área do leitor da biblioteca.</div>

        <div class="menu">
            <a href="buscar.php">Buscar livros</a>
            <a href="login_leitor.php">Trocar usuário</a>
            <a href="index.php">Tela inicial</a>
            <form method="post" action="login_leitor.php" style="display:inline;">
                <button type="submit" name="logout" class="logout">Sair</button>
            </form>
        </div>
    </div>
</body>
</html>
