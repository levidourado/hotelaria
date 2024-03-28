<?php

include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($cliente);
