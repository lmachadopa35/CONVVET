<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soluções Pendentes</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Arquivo de CSS externo -->
<style>
    /* Adicione este estilo diretamente aqui ou em seu arquivo CSS */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #DCA1FF;
        color: #333;
    }

    .appointments-container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 20px;
        color: #007bff;
    }

    .appointments-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .appointments-table thead tr {
        background-color: #007bff;
        color: #fff;
    }

    .appointments-table th,
    .appointments-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .appointments-table tr:hover {
        background-color: #f1f1f1;
    }

    .btn-action {
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .btn-action:hover {
        background-color: #4a148c;
    }

    .no-appointments {
        text-align: center;
        font-size: 1.2rem;
        color: #777;
        margin: 20px 0;
    }
    </style>
</head>

<body>
    <div class="appointments-container">
        <h3>Soluções Pendentes</h3>
        <?php if (!empty($appointments)): ?>
        <table class="appointments-table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?= isset($appointment['user_id']) ? htmlspecialchars($appointment['user_id']) : 'Não informado' ?>
                    </td>
                    <td><?= isset($appointment['type']) ? htmlspecialchars($appointment['type']) : 'Não informado' ?>
                    </td>
                    <td><?= isset($appointment['description']) ? htmlspecialchars($appointment['description']) : 'Não informado' ?>
                    </td>
                    <td><?= isset($appointment['status']) ? htmlspecialchars($appointment['status']) : 'Não informado' ?>
                    </td>
                    <td>
                        <a href="<?= site_url('clinic/update_status/'.$appointment['id'].'/atendido') ?>"
                            class="btn-action">
                            <i class="fas fa-check"></i> Atender
                        </a>
                        <a href="<?= site_url('clinic/update_status/'.$appointment['id'].'/rejeitado') ?>"
                            class="btn-action">
                            <i class="fas fa-times"></i> Rejeitar
                        </a>
                        <a href="<?= site_url('clinic/update_status/'.$appointment['id'].'/cancelado') ?>"
                            class="btn-action">
                            <i class="fas fa-ban"></i> Cancelar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p class="no-appointments">Nenhuma solução pendente no momento.</p>
        <?php endif; ?>
    </div>
    <script src="../js/navbar.js"></script>
</body>

</html>