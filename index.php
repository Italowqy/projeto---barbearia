<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT password FROM admins WHERE username = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['admin'] = $username;
                header("Location: horarios.php");
                exit();
            } else {
                $error = "Usuário ou senha incorretos.";
            }
        } else {
            $error = "Usuário ou senha incorretos.";
        }
    } catch (PDOException $e) {
        $error = "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barbearia N1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://img.elo7.com.br/product/685x685/302E322/papel-de-parede-fosco-adesivo-casual-111-barbearia-neutro-papel-de-parede-casual-cubos.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Fundo branco com opacidade */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .link-container {
            text-align: center;
            margin-top: 15px;
        }
        .link-container a {
            color: #007bff;
            text-decoration: none;
        }
        .link-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Barbearia N1</h1>
        <h2>Login do Cliente</h2>
        
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form action="" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" name="username" required>
            
            <label for="password">Senha:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>

        <div class="link-container">
            <p><a href="registro_admin.php">Clique se você ainda não for cliente!</a></p>
        </div>
    </div>
</body>
</html>
