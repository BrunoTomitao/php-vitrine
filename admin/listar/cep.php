<?php
// Conexão com o banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=vitrine", "root", "");

// Verifica se o parâmetro 'cep' foi passado na URL
if (isset($_GET['cep'])) {
    $cep = $_GET['cep'];

    // Consulta SQL para verificar se o CEP existe na tabela do banco de dados
    $sql = "SELECT * FROM cep WHERE cep = :cep LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":cep", $cep);
    $consulta->execute();

    // Retorna o resultado da consulta como JSON
    echo json_encode($consulta->fetch(PDO::FETCH_ASSOC));
}
?>
