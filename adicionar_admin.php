<?php
require 'conexao.php'; // Certifique-se de que este arquivo está configurado corretamente

// Dados do administrador
$username = 'admin';
$password = 'senha123';

// Criptografando a senha
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    $stmt->execute();
    echo "Administrador adicionado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao adicionar administrador: " . $e->getMessage();
}
?>
