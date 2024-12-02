<?php
function checkLogin($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT senhahash
    FROM funcionario
    WHERE email = ?
    SQL;

  try {
    // Neste caso utilize prepared statements para prevenir
    // inj. de S Q L, pois precisamos inserir dados fornecidos
    // pelo usuário na consulta SQL (o email do usuário)
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
    if (!$row) return false; // nenhum resultado (email não encontrado)

    return password_verify($senha, $row['senhahash']);
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

require "conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

if (checkLogin($pdo, $email, $senha))
  header("location: restrito/cadastro_func.html");
else
  header("location: login.html");
