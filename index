<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Barbearia N1</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Bem-vindo à Barbearia N1</h1>
    <h2>Agende seu horário</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cliente = $_POST['cliente'];
        $telefone = $_POST['telefone'];
        $data_agendamento = $_POST['data_agendamento'];
        $hora_agendamento = $_POST['hora_agendamento'];

        $sql = "INSERT INTO agendamentos (cliente, telefone, data_agendamento, hora_agendamento) 
                VALUES (:cliente, :telefone, :data_agendamento, :hora_agendamento)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data_agendamento', $data_agendamento);
        $stmt->bindParam(':hora_agendamento', $hora_agendamento);
        $stmt->execute();

        echo "<p class='success'>Agendamento realizado com sucesso!</p>";
    }
    ?>

    <form method="POST" action="">
        <label for="cliente">Nome do Cliente:</label>
        <input type="text" id="cliente" name="cliente" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>

        <label for="data_agendamento">Data:</label>
        <input type="date" id="data_agendamento" name="data_agendamento" required>

        <label for="hora_agendamento">Hora:</label>
        <input type="time" id="hora_agendamento" name="hora_agendamento" required>

        <button type="submit">Agendar</button>
    </form>

    <h2>Agendamentos</h2>
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Agendado em</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM agendamentos ORDER BY data_agendamento, hora_agendamento";
            foreach ($conn->query($sql) as $row) {
                echo "<tr>
                        <td>{$row['cliente']}</td>
                        <td>{$row['telefone']}</td>
                        <td>{$row['data_agendamento']}</td>
                        <td>{$row['hora_agendamento']}</td>
                        <td>{$row['criado_em']}</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
