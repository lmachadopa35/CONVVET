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



