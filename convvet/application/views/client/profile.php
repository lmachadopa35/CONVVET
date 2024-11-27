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
    <button class="open-btn" id="open-btn">&#9776;</button>
    <div id="navbar-container"></div>
    <script src="../js/navbar.js"></script>

    <div class="container">
        <!-- Cabeçalho do perfil -->
        <div class="profile-header">
            <!-- Exibição da foto de perfil -->
            <img src="<?php echo base_url('uploads/profile_pictures/' . $user->profile_picture); ?>" alt="Foto de Perfil" class="profile-photo">

            <div class="profile-info">
                <h3><?php echo $user->name; ?></h3>
                <p>Email: <?php echo $user->email; ?></p>
                <p>CPF: <?php echo $user->cpf; ?></p>
                <a href="../client_dashboard/edit_profile" class="btn-custom">Editar Perfil</a>
            </div>
        </div>

        <!-- Informações adicionais -->
        <div class="info-section">
            <div class="info-box">
                <h4>Informações de Contato</h4>
                <p><strong>Telefone:</strong> <?php echo $user->phone; ?></p>
                <p><strong>Endereço:</strong> <?php echo $user->address; ?></p>
            </div>
            <div class="info-box">
                <h4>Plano Atual</h4>
                <ul>
                    <li><?php echo $user->plan; ?> - Assinatura ativa</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
