<?php
require 'conexao.php'; // Certifique-se de que este arquivo conecta ao banco de dados corretamente

// Dados do administrador que você deseja criar
$username = 'chicomoedas';
$password = 'senha123'; // Substitua pela senha desejada

// Criptografando a senha
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // Insere o administrador no banco de dados
    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $hashedPassword);
    $stmt->execute();
    echo "Administrador inserido com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao inserir administrador: " . $e->getMessage();
}
?>
