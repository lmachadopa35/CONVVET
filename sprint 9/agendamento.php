<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $motivo = $_POST["motivo"];
    $hora = $_POST["hora"];
    $adata = $_POST["adata"];
    $clinica = $_POST["clinica"];

    function inserirRegistro($pdo, $motivo, $hora, $adata, $clinica) {
        $sql = "INSERT INTO agendamento (motivo, hora, adata, clinica) 
        VALUES (:motivo, :hora, :adata, :clinica)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':motivo', $motivo, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
        $stmt->bindParam(':adata', $adata, PDO::PARAM_STR);
        $stmt->bindParam(':clinica', $clinica, PDO::PARAM_STR);
        return $stmt->execute();
    }
}


  if (inserirRegistro($pdo, $motivo, $hora, $adata, $clinica)) {
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
<title>Formulário de Agendamento</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body class="ae">
    <a href="index.html" class="back-button">Voltar</a>
    <div class="foto">
        <img src="assets/convvet.png" alt="Descrição da Imagem">
    </div>
<div class="container">
    <form id="signupForm" method="post">
        <input type="text" id="motivo" name="motivo" placeholder="Motivo da Consulta" required>
        <input type="text" onkeyup="handleHour(event)" maxlength="5" id="hora" name="hora" placeholder="Horário da Consulta" required>
        <input type="text" onkeyup="handleDay(event)" maxlength="10"  id="adata" name="adata" placeholder="Data da Consulta" required>
        <input type="text" id="clinica" name="clinica" placeholder="Selecionar clínica" required>
        <button type="submit">Agendar</button>
    </form>
</div>
<script src="app.js"></script>
</body>
</html>