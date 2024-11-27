<!-- application/views/auth/register_clinic.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clínica</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastros.css'); ?>">
</head>
<body>
    <div class="register-container">
        <h2>Cadastro de Clínica</h2>
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= site_url('auth/do_register_clinic'); ?>">
            <div>
                <label for="name">Nome da Clínica:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" required>
            </div>
            <div>
                <label for="phone">Telefone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div>
                <label for="address">Endereço:</label>
                <input type="text" id="address" name="address" required>
            </div>
            
            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem uma conta? <a href="<?= site_url('auth/login'); ?>">Faça login</a></p>
    </div>
</body>
</html>
