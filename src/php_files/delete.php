<?php

include 'db.php';

$id = $_POST['id'];

$sql = "DELETE FROM clientes WHERE id = :id";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo "Cliente deletado com sucesso!";
} else {
    echo "Erro ao deletar cliente.";
}

