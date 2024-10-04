<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $motivo = $_POST["motivo"];
    $elocal = $_POST["elocal"];
    $clinica = $_POST["clinica"];

    function inserirRegistro($pdo, $motivo, $elocal, $clinica) {
        $sql = "INSERT INTO emergencia (motivo, elocal, clinica) 
        VALUES (:motivo, :elocal, :clinica)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':motivo', $motivo, PDO::PARAM_STR);
        $stmt->bindParam(':elocal', $elocal, PDO::PARAM_STR);
        $stmt->bindParam(':clinica', $clinica, PDO::PARAM_STR);
        return $stmt->execute();
    }
}


  if (inserirRegistro($pdo, $motivo, $elocal, $clinica)) {
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
<title>Formulário de Emergência</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body class="ae">
    <a href="index.html" class="back-button">Voltar</a>
    <div class="foto">
        <img src="assets/convvet.png" alt="Descrição da Imagem">
    </div>
<div class="container">
    <form id="signupForm" method="post">
        <input type="text" id="motivo" name="motivo" placeholder="Motivo da Emergência" required>
        <input type="text" id="elocal" name="elocal" placeholder="Informe a localização" required>
        <input type="text" id="clinica" name="clinica" placeholder="Selecionar clinica" required>
        <button type="submit">Acionar</button>
    </form>
</div>
<script src="app.js"></script>
</body>
</html>