<?php
include 'conexao.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM despesas WHERE id = :id");
$stmt->execute(['id' => $id]);
$despesa = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $data = $_POST['data'];

    $stmt = $pdo->prepare("UPDATE despesas SET descricao = :descricao, valor = :valor, categoria = :categoria, data = :data WHERE id = :id");
    $stmt->execute([
        'descricao' => $descricao,
        'valor' => $valor,
        'categoria' => $categoria,
        'data' => $data,
        'id' => $id,
    ]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Editar Despesa</title>
</head>
<body>
    <h1>Editar Despesa</h1>
    <form method="post">
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" value="<?= htmlspecialchars($despesa['descricao']) ?>" required>
        
        <label for="valor">Valor (R$):</label>
        <input type="number" id="valor" name="valor" step="0.01" value="<?= $despesa['valor'] ?>" required>
        
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria">
            <option value="Alimentação" <?= $despesa['categoria'] === 'Alimentação' ? 'selected' : '' ?>>Alimentação</option>
            <option value="Transporte" <?= $despesa['categoria'] === 'Transporte' ? 'selected' : '' ?>>Transporte</option>
            <option value="Lazer" <?= $despesa['categoria'] === 'Lazer' ? 'selected' : '' ?>>Lazer</option>
            <option value="Outros" <?= $despesa['categoria'] === 'Outros' ? 'selected' : '' ?>>Outros</option>
        </select>
        
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" value="<?= $despesa['data'] ?>" required>
        
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
