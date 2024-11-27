<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>

    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>


    <div class="container">
        <!-- Cabeçalho do perfil -->
        <div class="profile-header">
            <!-- Exibição da foto de perfil -->
            <img src="<?php echo base_url('uploads/profile_pictures/' . $user->profile_picture); ?>"alt="Foto de Perfil" class="profile-photo">

            <div class="profile-info">
                <h3><?php echo $user->name; ?></h3>
                <p>Email: <?php echo $user->email; ?></p>
                <p>CNPJ: <?php echo $user->cnpj; ?></p>
                <a href="../clinic/edit_profile" class="btn-custom">Editar Perfil</a>
            </div>
        </div>

        <!-- Informações adicionais -->
        <div class="info-section">
            <div class="info-box">
                <h4>Informações de Contato</h4>
                <p><strong>Telefone:</strong> <?php echo $user->phone; ?></p>
                <p><strong>Endereço:</strong> <?php echo $user->address; ?></p>
            </div>

            </div>
        </div>
    </div>

    <script src="../js/navbar.js"></script>
</body>

</html>