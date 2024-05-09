<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $user = $_POST["user"];
    $clinicName = $_POST["clinicName"];
    $endereco = $_POST["endereco"];
    $phone = $_POST["phone"];
    $commercialEmail = $_POST["commercialEmail"];
    $cnpj = $_POST["cnpj"];

    function inserirRegistro($pdo, $user, $clinicName, $endereco, $phone, $commercialEmail, $cnpj) {
        $sql = "INSERT INTO clinicas (user, clinicName, endereco, phone, commercialEmail, cnpj) 
        VALUES (:user, :clinicName, :endereco, :phone, :commercialEmail, :cnpj)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':clinicName', $clinicName, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':commercialEmail', $commercialEmail, PDO::PARAM_STR);
        $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
        return $stmt->execute();
    }
}


  if (inserirRegistro($pdo, $user, $clinicName, $endereco, $phone, $commercialEmail, $cnpj)) {
    header("Location: index.html");
    exit;
      echo "Registro inserido com sucesso!<br>" . "<a href='index.php'>HOME</a>";
  } else {
      echo 'Erro ao inserir o registro.';
     
 }


?>



