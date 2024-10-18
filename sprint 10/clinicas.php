<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $fullName = $_POST["fullName"];
  $email = $_POST["email"];
    $senha = $_POST["senha"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $phone = $_POST["phone"];
    $animal = $_POST["animal"];
    $race = $_POST["race"];
    $animalName = $_POST["animalName"];

    function inserirRegistro($pdo, $fullName, $email, $senha, $cpf, $endereco, $phone, $animal, $race, $animalName) {
        $sql = "INSERT INTO clientes (fullName, email, senha, cpf, endereco, phone, animal, race, animalName) 
        VALUES (:fullName, :email, :senha, :cpf, :endereco, :phone, :animal, :race, :animalName)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':animal', $animal, PDO::PARAM_STR);
        $stmt->bindParam(':race', $race, PDO::PARAM_STR);
        $stmt->bindParam(':animalName', $animalName, PDO::PARAM_STR);
        return $stmt->execute();
    }
}


  if (inserirRegistro($pdo, $fullName, $email, $senha, $cpf, $endereco, $phone, $animal, $race, $animalName)) {
    header("Location: index.html");
    exit;
      echo "Registro inserido com sucesso!<br>" . "<a href='index.php'>HOME</a>";
  } else {
      echo 'Erro ao inserir o registro.';
     
 }


?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Clínicas</title>
<link rel="stylesheet" href="css/cadastros.css">
<link rel="stylesheet" href="css/navbar.css">
<script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js"></script>
</head>
<body>
    <div class="foto">
        <img src="assets/convvet.png" alt="Descrição da Imagem">
    </div>
<div class="container">
    <form id="clinicForm" method="post">
        <input type="text" name="user" id="user" placeholder="Nome de usuário" required>
        <input type="text" name="clinicName" id="clinicName" placeholder="Nome da Clínica" required>
        <input type="text" name="endereco" id="endereco" placeholder="Endereço completo" required>
        <input type="tel" name="phone" id="phone" placeholder="Telefone de contato" required>
        <input type="email" name="commercialEmail" id="commercialEmail" placeholder="Email comercial" required>
        <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" required>
        <button type="submit">Cadastrar Clínica</button>
    </form>
</div>
<div id="nav-bar">
    <input id="nav-toggle" type="checkbox"/>
    <div id="nav-header"><a id="nav-title" href="index.html">Convvet</a>
      <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
      <hr/>
    </div>
    <div id="nav-content">
      
      <a href="index.html"><div class="nav-button"><i class="fas fa-palette"></i><span>Voltar</span></div></a>
      <div id="nav-content-highlight"></div>
    </div>
    <input id="nav-footer-toggle" type="checkbox"/>
    
  </div>
<script src="clinicApp.js"></script>
</body>
</html>
