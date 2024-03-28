<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = preg_replace('/\D/', '', $_POST['telefone']);
$email = $_POST['email'];
$cpf = preg_replace('/\D/', '', $_POST['cpf']);
$data_de_nascimento = $_POST['data_de_nascimento'];

$sql = "UPDATE clientes SET " .
    "nome = :nome, " .
    "telefone = :telefone, " .
    "email = :email, " .
    "cpf = :cpf, " .
    "data_de_nascimento = :data_de_nascimento " .
    "WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':id', $id);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':data_de_nascimento', $data_de_nascimento);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Cliente atualizado com sucesso!"]);
} else {
    $errorInfo = $stmt->errorInfo();
    echo json_encode(["success" => false, "message" => "Erro ao atualizar cliente: {$errorInfo[2]}"]);
}
