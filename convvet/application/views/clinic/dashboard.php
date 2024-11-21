<!-- application/views/clinic/dashboard.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard da Clínica</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css'); ?>">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bem-vindo ao seu Dashboard, <?= $this->session->userdata('name'); ?>!</h2>
        <p>Aqui você pode gerenciar consultas e agendamentos.</p>

        <div class="menu-options">
            <a href="<?= site_url('clinic/profile'); ?>">Ver Perfil</a>
            <a href="<?= site_url('clinic/appointments'); ?>">Gerenciar Consultas</a>
            <a href="<?= site_url('auth/logout'); ?>">Sair</a>
        </div>
    </div>
</body>
</html>
