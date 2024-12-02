<?php
    require 'conexaoMysql.php';
    $pdo = mysqlConnect();
    $sql = <<<SQL
    SELECT codigo, nome, especialidade
    FROM medico
    SQL;
    try {
        $stmt = $pdo->query($sql);
        $arrayMedicos = $stmt->fetchAll(PDO::FETCH_OBJ);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arrayMedicos);
    } catch (Exception $e) {
        exit('Falha inesperada: ' . $e->getMessage());
    }
?>
