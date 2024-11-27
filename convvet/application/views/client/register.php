<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>

<button class="open-btn" id="open-btn">&#9776;</button>
<div id="navbar-container"></div>
<script src="../js/navbar.js"></script>

<div class="foto">
    <img src="../assets/convvet.png" alt="Descrição da Imagem">
</div>

<div class="container">
    <?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/do_register_client'); ?>">
        <input placeholder="Nome Completo" type="text" id="name" name="name" required>
        <input placeholder="Email" type="email" id="email" name="email" required>
        <input placeholder="Senha" type="password" id="password" name="password" required>
        <input placeholder="CPF" type="text" id="cpf" name="cpf" required>
        <input placeholder="Telefone" type="text" id="phone" name="phone" required>
        <input placeholder="Endereço" type="text" id="address" name="address" required>

        <select name="plan" id="plan" required>
            <option value="plano1">Plano 1</option>
            <option value="plano2">Plano 2</option>
            <option value="plano3">Plano 3</option>
        </select>

        <button type="submit">Cadastrar</button>

        <div style="justify-content: center; display: flex;">
            <p style="color: white;">Já tem uma conta? <a style="color: white;" href="<?= site_url('auth/login'); ?>">Faça login</a></p>
        </div>
    </form>
</div>

<script src="app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var cpfMask = new Inputmask("999.999.999-99");
        cpfMask.mask(document.getElementById("cpf"));
        
        var phoneMask = new Inputmask("(99) 99999-9999");
        phoneMask.mask(document.getElementById("phone"));
    });
</script>

</body>
</html>
