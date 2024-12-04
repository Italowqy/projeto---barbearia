<?php
require 'conexao.php';

$username = 'daniel brandao';
$password = 'senha123';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $conn->prepare("
        INSERT INTO admins (username, password) 
        VALUES (:username, :password)
    ");

    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);

    $stmt->execute();
    echo "Administrador adicionado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao adicionar administrador: " . htmlspecialchars($e->getMessage());
}
?>
