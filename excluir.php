<?php
include 'conexao.php';

// Obtém o ID da despesa a ser excluída
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Prepara a exclusão da despesa no banco
        $stmt = $pdo->prepare("DELETE FROM despesas WHERE id = :id");
        $stmt->execute(['id' => $id]);

        // Redireciona para a página principal após a exclusão
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die("Erro ao excluir despesa: " . $e->getMessage());
    }
} else {
    // Redireciona de volta caso o ID não seja fornecido
    header('Location: index.php');
    exit;
}
?>
