<?php

  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  $nome = $_POST["nome"] ?? "";
  $sexo = $_POST["sexo"] ?? "";
  $email = $_POST["email"] ?? "";
  $telefone = $_POST["telefone"] ?? "";

  $datahora = $_POST["datahora"] ?? "";
  $codmedico = $_POST["codmedico"] ?? "";


  $sql1 = <<<SQL
    INSERT INTO paciente (nome, sexo, email, telefone)
    VALUES (:nome, :sexo, :email, :telefone);
    SQL; 

  $sql2 = <<<SQL
    INSERT INTO agendamento (datahora, codmedico)
    VALUES (:datahora, :codmedico);
    SQL; 

  try {
      $pdo->beginTransaction();

      $stmt1 = $pdo->prepare($sql1);
      $stmt1->bindParam(':nome', $nome);
      $stmt1->bindParam(':sexo', $sexo);
      $stmt1->bindParam(':email', $email);
      $stmt1->bindParam(':telefone', $telefone);
      $stmt1->execute();
    
      $idmedico = $pdo->lastInsertId();
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->bindParam(':datahora', $datahora);
      $stmt2->bindParam(':codmedico', $idmedico);
      $stmt2->execute();

      $pdo->commit();

      header("location: index.html");
      exit();
  } 
  catch (Exception $e) {  
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
  }
?>