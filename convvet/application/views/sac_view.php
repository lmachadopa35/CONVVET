<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SAC - CONVVET</title>
<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
</head>
<body class="home">

<div class="menu">
    <img id="logo" class="logo-image" src="<?= base_url('assets/convvet.png') ?>" alt="Logo">
</div>

<div class="container">
    <form id="loginForm" method="post" action="<?= site_url('SACController/submit') ?>">
        <input type="text" id="nome" name="nome" placeholder="Seu Nome" value="<?= set_value('nome') ?>" required>
        <?= form_error('nome') ?>

        <input type="email" id="email" name="email" placeholder="Seu E-mail" value="<?= set_value('email') ?>" required>
        <?= form_error('email') ?>

        <input type="text" id="assunto" name="assunto" placeholder="Assunto" value="<?= set_value('assunto') ?>" required>
        <?= form_error('assunto') ?>

        <textarea id="mensagem" name="mensagem" rows="5" placeholder="Sua Mensagem" required maxlength="250"><?= set_value('mensagem') ?></textarea>
        <?= form_error('mensagem') ?>

        <button type="submit">Enviar</button>
    </form>

    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?= $this->session->flashdata('success') ?></p>
    <?php endif; ?>
</div>


<div style="text-align: center;">
        <a href="<?= base_url('client_dashboard') ?>" class="back-button">Voltar</a>
    </div>
<script src="<?= base_url('app.js') ?>"></script>
</body>
</html>
