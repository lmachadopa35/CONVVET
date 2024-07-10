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



