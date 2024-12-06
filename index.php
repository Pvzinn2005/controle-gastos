<?php
include 'conexao.php';

// Busca todas as despesas
$query = $pdo->query("SELECT * FROM despesas ORDER BY data DESC");
$despesas = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Controle de Gastos</title>
</head>
<body>
    <h1>Controle de Gastos</h1>
    <a href="adicionar.php" class="btn">Adicionar Nova Despesa</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($despesas as $despesa): ?>
                <tr>
                    <td><?= $despesa['id'] ?></td>
                    <td><?= htmlspecialchars($despesa['descricao']) ?></td>
                    <td>R$ <?= number_format($despesa['valor'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($despesa['categoria']) ?></td>
                    <td><?= $despesa['data'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $despesa['id'] ?>">Editar</a>
                        <a href="excluir.php?id=<?= $despesa['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta despesa?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
