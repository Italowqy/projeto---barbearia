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
    <title>Adicionar Horário - Barbearia N1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        h1 {
            margin: 0;
        }
        h2 {
            text-align: center;
            color: #444;
            margin-top: 30px;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="text"], input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #343a40;
            color: white;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Barbearia N1</h1>
    </header>

    <div class="container">
        <h2>Adicionar Novo Horário</h2>
        
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form action="" method="POST">
            <label for="cliente">Nome do Cliente:</label>
            <input type="text" name="cliente" required>
            
            <label for="horario">Horário (AAAA-MM-DD HH:MM:SS):</label>
            <input type="datetime-local" name="horario" required>
            
            <button type="submit">Adicionar</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Barbearia N1. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
