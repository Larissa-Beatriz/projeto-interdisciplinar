<?php

  require "../conexaoMysql.php";
  $pdo = mysqlConnect();

  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $estadocivil = $_POST["estadocivil"];
  $dtnasc = $_POST["dtnasc"];
  $funcao = $_POST["funcao"];

  // calcula um hash de senha seguro para armazenar no BD
  $senhahash = password_hash($senha, PASSWORD_DEFAULT);

  $sql = <<<SQL
      INSERT INTO funcionario (nome, email, senhahash, datanascimento, estadocivil, funcao)
      VALUES (?, ?, ?, ?, ?, ?)
      SQL;

  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senhahash, $dtnasc, $estadocivil, $funcao]);

    $pdo->commit();
  } 
  catch (Exception $e){
    $pdo->rollBack();        
  }
  header("location: funcionarios.php");
?>