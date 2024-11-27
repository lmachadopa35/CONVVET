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

    <div class="foto">
        <img src="../assets/convvet.png" alt="Descrição da Imagem">
    </div>

    <div class="container">
        <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('auth/do_register_clinic'); ?>">
            <input placeholder="Nome da Clinica" type="text" id="name" name="name" required>
            <input placeholder="Email" type="email" id="email" name="email" required>
            <input placeholder="Senha" type="password" id="password" name="password" required>
            <input placeholder="CNPJ" type="text" id="cnpj" name="cnpj" required>
            <input placeholder="Telefone" type="text" id="phone" name="phone" required>
            <input placeholder="Endereco Fisico" type="text" id="address" name="address" required>
            <button type="submit">Cadastrar</button>
            <div style="justify-content: center; display: flex;">
                <p style="color: white;">Já tem uma conta? <a style="color: white;"
                        href="<?= site_url('auth/login'); ?>">Faça login</a></p>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var phoneMask = new Inputmask("(99) 99999-9999");
            phoneMask.mask(document.getElementById("phone"));
            
            var cnpjMask = new Inputmask("99.999.999/9999-99");
            cnpjMask.mask(document.getElementById("cnpj"));
        });
</script>
<script src="../js/navbar.js"></script>
</body>
</html>