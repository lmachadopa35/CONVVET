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



