<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "";
$banco = "biblioteca";

$adminConexao = @mysqli_connect($host, $user, $pass);

if ($adminConexao) {
    mysqli_query($adminConexao, "CREATE DATABASE IF NOT EXISTS `$banco` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    mysqli_close($adminConexao);
}

$conexao = mysqli_connect($host, $user, $pass, $banco);

if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

mysqli_set_charset($conexao, "utf8mb4");

function criarTabelaSeNaoExistir($conexao, $sql, $nomeTabela) {
    if (!mysqli_query($conexao, $sql)) {
        die("Erro ao criar a tabela $nomeTabela: " . mysqli_error($conexao));
    }
}

criarTabelaSeNaoExistir(
    $conexao,
    "CREATE TABLE IF NOT EXISTS `bibliotecario` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `nome` VARCHAR(30) NOT NULL,
        `senha` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
    "bibliotecario"
);

criarTabelaSeNaoExistir(
    $conexao,
    "CREATE TABLE IF NOT EXISTS `funcionario` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `nome` VARCHAR(30) NOT NULL,
        `senha` VARCHAR(255) NOT NULL,
        `telefone` VARCHAR(15) NOT NULL,
        `cpf` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
    "funcionario"
);

criarTabelaSeNaoExistir(
    $conexao,
    "CREATE TABLE IF NOT EXISTS `leitores` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `nome` VARCHAR(30) NOT NULL,
        `senha` VARCHAR(255) NOT NULL,
        `telefone` VARCHAR(15) NOT NULL,
        `cpf` VARCHAR(255) NOT NULL,
        `endereco` VARCHAR(60) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
    "leitores"
);

criarTabelaSeNaoExistir(
    $conexao,
    "CREATE TABLE IF NOT EXISTS `livros` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `status` VARCHAR(20) NOT NULL DEFAULT 'disponivel',
        `titulo` VARCHAR(80) NOT NULL,
        `autor` VARCHAR(80) NOT NULL,
        `genero` VARCHAR(30) NOT NULL,
        `quantidade` INT NOT NULL DEFAULT 0,
        `descricao` TEXT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
    "livros"
);

criarTabelaSeNaoExistir(
    $conexao,
    "CREATE TABLE IF NOT EXISTS `emprestimos` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_livro` INT NOT NULL,
        `id_leitor` INT NOT NULL,
        `data_emprestimo` DATETIME NOT NULL,
        `data_prevista` DATE NOT NULL,
        `data_devolucao` DATETIME NULL,
        `multa` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        `status` VARCHAR(20) NOT NULL DEFAULT 'emprestado',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
    "emprestimos"
);
?>
