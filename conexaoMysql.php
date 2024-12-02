<?php

function mysqlConnect()
{
  $db_host = "sql105.infinityfree.com";
  $db_username = "if0_37829448";
  $db_password = "dE4H3Kr8yjaDd";
  $db_name = "if0_37829448_gerenciamentodb";

  // dsn é apenas um acrônimo de database source name
  $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ativa o modo de erros para lançar exceções    
    PDO::ATTR_PERSISTENT    => true, // ativa o uso de conexões persistentes para maior eficiência
  ];

  try {
    $pdo = new PDO($dsn, $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
  }
}

?>
