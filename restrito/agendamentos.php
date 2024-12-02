<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agendamentos</title>
    <link rel="stylesheet" href="styles_restrito.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="text-center">
            <img src="../images/logo1.png" class="rounded" alt="logo" height="70" width="70">
        </div>
        <h1 class="text-center">Lista de Agendamentos</h1>
    </header>
    <nav>
        <ul class="nav justify-content-center">
            <li class="nav-item"><a class="nav-link" href="cadastro_func.html">Cadastro de Funcionário</a></li>
            <li class="nav-item"><a class="nav-link" href="cadastro_medico.html">Cadastro de Médico</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Lista de Agendamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="funcionarios.php">Lista de Funcionários</a></li>
            <li class="nav-item"><a class="nav-link" href="medicos.php">Lista de Médicos</a></li>
            <li class="nav-item"><a class="nav-link" href="lista_contatos.html">Lista de Contatos</a></li>
            <li class="nav-item"><a class="nav-link" href="../index.html">Sair</a></li>
        </ul>
    </nav>
<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
    SELECT age.codigo
         , age.datahora
         , med.nome as medico
         , med.especialidade
         , pac.nome as paciente
         , pac.email
         , pac.telefone
      FROM agendamento age 
      JOIN medico med on med.codigo = age.codmedico 
      JOIN paciente pac on pac.codigo = age.codpaciente
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Agendamentos</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <style>
    body {
      padding-top: 2rem;
    }
    img {
      width: 20px;
    }
  </style>  
</head>

<body>

  <div class="container">
    <h1>Lista de Agendamentos</h1>
    <table class="table table-striped table-hover">
      <tr>
        <th>Código</th>
        <th>Data/Hora</th>
        <th>Médico</th>
        <th>Especialidade</th>
        <th>Paciente</th>
        <th>Email</th>
        <th>Telefone</th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {

        $codigo = htmlspecialchars($row['codigo']);
        $datahora = $row['datahora'];
        $medico = htmlspecialchars($row['medico']);
        $especialidade = htmlspecialchars($row['especialidade']);
        $paciente = htmlspecialchars($row['paciente']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);

        echo <<<HTML
          <tr>
            <td>$codigo</td> 
            <td>$datahora</td>
            <td>$medico</td>
            <td>$especialidade</td>
            <td>$paciente</td>
            <td>$email</td>
            <td>$telefone</td>
          </tr>      
        HTML;
      }
      ?>

    </table>
    
  </div>

  </body>
    <footer>
        <span><em>Endereço: Av. Marcos de Freitas Costa, n° 369, Uberlândia - MG</em></span><br>
        <span><em>© 2024 Serenity Clínica Médica</em></span>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    </html>