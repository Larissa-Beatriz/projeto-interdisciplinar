<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$dtnasc = $_POST["dtnasc"] ?? "";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";
$cep = $_POST["cep"] ?? "";
$endereco = $_POST["endereco"] ?? "";
$bairro = $_POST["bairro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$especialidade = $_POST["especialidade"] ?? "";
$crm = $_POST["crm"] ?? "";
$estadocivil = $_POST["estadocivil"] ?? "";


$sql1 = <<<SQL
  INSERT INTO medico (nome, cpf, datanasc, email, senha, cep, endereco, bairro, cidade, estado, especialidade, crm)
  VALUES (:nome, :cpf, :dtnasc, :email, :senha, :cep, :endereco, :bairro, :cidade, :estado, :especialidade, :crm);
  SQL; 

$sql2 = <<<SQL
  INSERT INTO funcionario (nome, email, senhahash, datanascimento, estadocivil, funcao)
  VALUES (:nome, :email, :senha, :dtnasc, :estadocivil, :especialidade);
  SQL; 

try {
    $pdo->beginTransaction();

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->bindParam(':nome', $nome);
    $stmt1->bindParam(':cpf', $cpf);
    $stmt1->bindParam(':dtnasc', $dtnasc);
    $stmt1->bindParam(':email', $email);
    $stmt1->bindParam(':senha', $senha);
    $stmt1->bindParam(':cep', $cep);
    $stmt1->bindParam(':endereco', $endereco);
    $stmt1->bindParam(':bairro', $bairro);
    $stmt1->bindParam(':cidade', $cidade);
    $stmt1->bindParam(':estado', $estado);
    $stmt1->bindParam(':especialidade', $especialidade);
    $stmt1->bindParam(':crm', $crm);
    $stmt1->execute();
  

    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':nome', $nome);
    $stmt2->bindParam(':email', $email);
    $stmt2->bindParam(':senha', $senha);
    $stmt2->bindParam(':dtnasc', $dtnasc);
    $stmt2->bindParam(':estadocivil', $estadocivil);
    $stmt2->bindParam(':especialidade', $especialidade);
    $stmt2->execute();

    $pdo->commit();

    header("location: cadastro_medico.html");
    exit();
} 
catch (Exception $e) {  
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
