<?php
include 'db.php';

$sql = "SELECT * FROM clientes";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($clientes as $cliente) {
    echo "ID: " . $cliente['id'] . " - Nome: " . $cliente['nome'] . " - Telefone: " . $cliente['telefone'] . " - Email: " . $cliente['email'] . " - CPF: " . $cliente['cpf'] . " - Data de Nascimento: " . $cliente['data_de_nascimento'] . "<br>";
}
?>