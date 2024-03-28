<?php

include 'db.php';

$nome = $_POST['nome'];
$telefone = preg_replace('/\D/', '', $_POST['telefone']);
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$data_de_nascimento = $_POST['data_de_nascimento'];
$data_de_nascimento = DateTime::createFromFormat('d/m/Y', $data_de_nascimento)->format('Y-m-d');

$sql = "INSERT INTO clientes (nome, telefone, email, cpf, data_de_nascimento) " .
       "VALUES (:nome, :telefone, :email, :cpf, :data_de_nascimento)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':data_de_nascimento', $data_de_nascimento);

if ($stmt->execute()) {
    echo "Cliente criado com sucesso!";
} else {
    echo "Erro ao criar cliente: " . print_r($stmt->errorInfo(), true);
}
