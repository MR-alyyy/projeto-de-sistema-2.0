<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Livros</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        form { margin-bottom: 20px; }
        .card { margin-top: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; }
        .erro { color: red; }
        a { display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>

<form method="post" action="">
    <label for="buscar">Título:</label>
    <input id="buscar" name="Buscar" type="text" value="<?php echo isset($_POST['Buscar']) ? htmlspecialchars($_POST['Buscar']) : ''; ?>">
    <input type="submit" value="Pesquisar" />
    <a href="tela_principal.php">Voltar</a>
</form>

<?php
if (isset($_POST['Buscar'])) {
    include "conexao.php";

    $buscar = trim($_POST['Buscar']);
    $sql = mysqli_query($conexao, "SELECT * FROM livros WHERE titulo LIKE '%" . mysqli_real_escape_string($conexao, $buscar) . "%' ORDER BY titulo");
    $row = mysqli_num_rows($sql);

    if ($row > 0) {
        while ($linha = mysqli_fetch_array($sql)) {
            $status = $linha['status'];
            $titulo = $linha['titulo'];
            $autor = $linha['autor'];
            $genero = $linha['genero'];
            $quantidade = $linha['quantidade'];
            $descricao = $linha['descricao'];

            echo "<div class='card'>";
            echo "<strong>Status:</strong> $status <br />";
            echo "<strong>Título:</strong> $titulo <br />";
            echo "<strong>Autor:</strong> $autor <br />";
            echo "<strong>Gênero:</strong> $genero <br />";
            echo "<strong>Quantidade:</strong> $quantidade <br />";
            echo "<strong>Descrição:</strong> $descricao <br />";
            echo "</div>";
        }
    } else {
        echo "<p class='erro'>Livro não encontrado...</p>";
    }
}
?>

</body>
</html>
