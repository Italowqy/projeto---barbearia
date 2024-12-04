<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
require 'conexao.php';


$stmt = $conn->query("SELECT id, cliente, horario FROM agendamentos ORDER BY horario ASC");
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Horários - Barbearia N1</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }
        a:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e9ecef;
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
        <h2>Agendamentos</h2>
        <a href="adicionar_horario.php">Adicionar Novo Horário</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Horário</th>
            </tr>
            <?php foreach ($agendamentos as $agendamento): ?>
            <tr>
                <td><?= $agendamento['id'] ?></td>
                <td><?= htmlspecialchars($agendamento['cliente']) ?></td>
                <td><?= $agendamento['horario'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Barbearia N1 balão dos grandes. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
