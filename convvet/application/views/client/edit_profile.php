<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/edit_profile.css">
</head>

<body>
    <button class="open-btn" id="open-btn">&#9776;</button>
    <div id="navbar-container"></div>
    <script src="../js/navbar.js"></script>
    <div class="container">
        <!-- Cabeçalho do perfil -->
        <div class="profile-header">
            <img src="<?php echo base_url('uploads/profile_pictures/' . $user->profile_picture); ?>"
                alt="Foto de Perfil" class="profile-photo">

            <!-- Formulário para upload de foto -->
            <form action="<?php echo site_url('client/upload_foto'); ?>" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profile_picture">Foto de Perfil</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-custom">Salvar Alterações</button>
                </div>
            </form>

            <div class="profile-info">
                <h3>Editar Perfil</h3>
                <p>Atualize suas informações abaixo:</p>
            </div>
        </div>

        <!-- Formulário de edição -->
        <div class="edit-form">
            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php endif; ?>

            <form action="<?php echo site_url('client_dashboard/update_profile'); ?>" method="post">
                <!-- Campos para editar informações principais -->
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="<?php echo $user->name; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $user->email; ?>"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $user->phone; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" name="address" id="address" value="<?php echo $user->address; ?>"
                        class="form-control">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-custom">Salvar Alterações</button>
                    <a href="profile" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= base_url('../js/navbar.js'); ?>"></script>
</body>

</html>
