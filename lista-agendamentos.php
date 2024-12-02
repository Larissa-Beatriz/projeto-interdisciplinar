<?php

require "conexaoprojeto.php"; 
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
    SELECT pac.nome, pac.sexo, pac.email, pac.telefone
         , age.datahora, med.nome as medico
      FROM  paciente pac
      JOIN agendamento age on pac.codigo = age.codpaciente
      JOIN medico med on med.codigo = age.codmedico
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Falha ao executar SQL: ' . $e->getMessage());
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agendamento</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h3>Dados de <b>Agendamento</b></h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Data/Hora</th>
        <th>Nome Médico</th>
        <th>Nome Paciente</th>
        <th>Sexo Paciente</th>
        <th>Email Paciente</th>
        <th>Telefone Paciente</th>
      </tr>
      <?php
      while ($row = $stmt->fetch()) 
      {
        $datahora = htmlspecialchars($row['datahora']);
        $medico = htmlspecialchars($row['medico']);
        $nome = htmlspecialchars($row['nome']);
        $sexo = htmlspecialchars($row['sexo']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);

        echo <<<HTML
        <tr>
          <td>$datahora</td>
          <td>$medico</td>
          <td>$nome</td>
          <td>$sexo</td>
          <td>$email</td>
          <td>$telefone</td>
        </tr>      
        HTML;
      }
      ?>
    </table>
    <p><a href="../index.html">Menu de opções</a></p>
  </div>

</body>

</html>