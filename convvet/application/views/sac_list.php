<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mensagens Enviadas - SAC</title>
<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .menu {
        background-color: #343a40;
        padding: 10px 20px;
        text-align: center;
    }

    .menu img {
        max-height: 60px;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #343a40;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
        text-transform: uppercase;
        font-size: 14px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e9ecef;
    }

    td {
        font-size: 14px;
        color: #333;
    }

    .empty-message {
        text-align: center;
        font-size: 18px;
        color: #6c757d;
        padding: 20px;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        text-align: center;
        border-radius: 4px;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="menu">
    <img id="logo" class="logo-image" src="<?= base_url('assets/convvet.png') ?>" alt="Logo">
</div>

<div class="container">
    <h1>Mensagens Enviadas</h1>

    <?php if (!empty($mensagens)): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Assunto</th>
                    <th>Mensagem</th>
                    <th>Data de Envio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mensagens as $mensagem): ?>
                    <tr>
                        <td><?= $mensagem->id ?></td>
                        <td><?= htmlspecialchars($mensagem->nome) ?></td>
                        <td><?= htmlspecialchars($mensagem->email) ?></td>
                        <td><?= htmlspecialchars($mensagem->assunto) ?></td>
                        <td><?= htmlspecialchars($mensagem->mensagem) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($mensagem->created_at)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="empty-message">Nenhuma mensagem foi enviada ainda.</p>
    <?php endif; ?>

    <div style="text-align: center;">
        <a href="<?= base_url('clinic_dashboard') ?>" class="back-button">Voltar</a>
    </div>
</div>

</body>
</html>
