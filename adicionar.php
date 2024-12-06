<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $data = $_POST['data'];

    $stmt = $pdo->prepare("INSERT INTO despesas (descricao, valor, categoria, data) VALUES (:descricao, :valor, :categoria, :data)");
    $stmt->execute([
        'descricao' => $descricao,
        'valor' => $valor,
        'categoria' => $categoria,
        'data' => $data,
    ]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Adicionar Nova Despesa</title>
</head>
<body>
    <h1>Adicionar Nova Despesa</h1>
    <form method="post">
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>
        
        <label for="valor">Valor (R$):</label>
        <input type="number" id="valor" name="valor" step="0.01" required>
        
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria">
            <option value="Alimentação">Alimentação</option>
            <option value="Transporte">Transporte</option>
            <option value="Lazer">Lazer</option>
            <option value="Outros">Outros</option>
        </select>
        
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
        
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
