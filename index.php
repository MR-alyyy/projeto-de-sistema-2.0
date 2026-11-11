<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(99, 102, 241, 0.25);
            border-radius: 20px;
            padding: 40px 30px;
            width: min(600px, 90%);
            text-align: center;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }
        h1 {
            margin-top: 0;
            font-size: 2.2rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
        }
        a {
            display: inline-block;
            padding: 14px 18px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Biblioteca</h1>
        <div class="links">
            <a href="login_bibliotecario.php">Bibliotecário</a>
            <a href="login_funcionario.php">Funcionário</a>
            <a href="login_leitor.php">Leitor</a>
        </div>
    </div>
</body>
</html>
