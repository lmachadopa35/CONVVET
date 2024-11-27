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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CONVVET</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbar.css">

    <style>
    select {
        padding: 10px;
        margin-bottom: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 15px;
        background: #ffffff;
    }
    </style>

</head>

<body class="home">

    <button class="open-btn" id="open-btn">&#9776;</button>
    <div id="navbar-container"></div>
    <script src="../js/navbar.js"></script>

    <div class="menu">
        <img id="logo" class="logo-image" src="../assets/convvet.png" alt="Logo">
    </div>
    <div class="container">
        <form action="<?= site_url('auth/do_login'); ?>" method="POST">
            <input name="email" type="email" id="username" placeholder="E-mail" required>
            <input name="password" type="password" id="password" placeholder="Senha" required>
            <select name="role" required>
                <option value="client">Cliente</option>
                <option value="clinic">Clínica</option>
                <option value="admin">Administrador</option>
            </select>
            <button type="submit">Entrar</button>
            <a href="../auth/register_client" class="cadcli">Cadastro de clientes</a>
            <a href="../auth/register_clinic" class="cadcli">Cadastro de clinicas</a>


    </div>



    <script src="../js/app.js"></script>
</body>

</html>