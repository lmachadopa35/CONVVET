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


</head>

<body class="home">

    <div class="menu">
        <img id="logo" class="logo-image" src="../assets/convvet.png" alt="Logo">
    </div>
    <div class="container">
    <form action="<?= site_url('auth/do_login'); ?>" method="POST">
            <input name="email" type="email" id="username" placeholder="E-mail" required>
            <input name="password" type="password" id="password" placeholder="Senha" required>

            <button type="submit">Entrar</button>
            <a href="clientes.html" class="cadcli">Cadastro de clientes</a>
            <a href="clinicas.html" class="cadcli">Cadastro de clinicas</a>


    </div>

    <div class="container">

        <div id="nav-bar">
            <input id="nav-toggle" type="checkbox" />
            <div id="nav-header"><a id="nav-title" href="index.html">Convvet</a>
                <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
                <hr />
            </div>
            <div id="nav-content">

                <a href="index.html">
                    <div class="nav-button"><i class="fas fa-palette"></i><span>Voltar</span></div>
                </a>

                <div id="nav-content-highlight"></div>
            </div>
            <input id="nav-footer-toggle" type="checkbox" />

        </div>

    </div>
    <script src="../js/app.js"></script>
</body>

</html>