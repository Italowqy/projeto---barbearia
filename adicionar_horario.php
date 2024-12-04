<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = $_POST['cliente'];
    $horario = $_POST['horario'];

    try {
        $stmt = $conn->prepare("INSERT INTO agendamentos (cliente, horario) VALUES (:cliente, :horario)");
        $stmt->bindValue(':cliente', $cliente);
        $stmt->bindValue(':horario', $horario);
        $stmt->execute();
        header("Location: horarios.php");
        exit();
    } catch (PDOException $e) {
        $error = "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Horário - Barbearia</title>
</head>
<body>
    <h2>Adicionar Novo Horário</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="POST">
        <label for="cliente">Nome do Cliente:</label>
        <input type="text" name="cliente" required>
        <br>
        <label for="horario">Horário (AAAA-MM-DD HH:MM:SS):</label>
        <input type="datetime-local" name="horario" required>
        <br>
        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
