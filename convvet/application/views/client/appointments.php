<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Agendamentos</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/styles.css">
<style>
        /* Resetando alguns estilos padrões */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Estilo geral da página */
    body {
        font-family: Arial, sans-serif;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    .appointments-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .appointments-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
    }

    .appointments-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .appointments-table th, .appointments-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .appointments-table th {
        background-color: #9e53f7;
        color: white;
    }

    .appointments-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .appointments-table tr:hover {
        background-color: #f1f1f1;
    }

    /* Estilo das células de status */
    .appointments-table .pending {
        color: #f39c12;
    }

    .appointments-table .completed {
        color: #27ae60;
    }

    .appointments-table .cancelled {
        color: #e74c3c;
    }

    /* Estilo dos links de ação */
    .appointments-table a {
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 0.9rem;
        display: inline-block;
        text-align: center;
    }

    .btn-edit {
        background-color: #9e53f7;
        color: white;
    }

    .btn-delete {
        background-color: #d9534f;
        color: white;
    }

    /* Efeito de hover nas ações */
    .appointments-table a:hover {
        opacity: 0.8;
    }

    /* Estilos responsivos */
    @media screen and (max-width: 768px) {
        .appointments-table th, .appointments-table td {
            font-size: 14px;
            padding: 8px;
        }

        .appointments-table a {
            font-size: 0.8rem;
            padding: 4px 8px;
        }
    }

</style>
</head>
<body>
    <div class="appointments-container">
        <h3 class="appointments-title">Meus Agendamentos</h3>
        <table class="appointments-table">
            <thead>
                <tr>
                    <th>Clínica</th>
                    <th>Pet</th>

                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= $appointment->clinic_name ?></td>
                        <td><?= $appointment->pet_name ?></td>

                        <td><?= $appointment->description ?></td>
                        <td class="<?= strtolower($appointment->status) ?>"><?= $appointment->status ?></td>
                        <td>
                            <a href="<?= site_url('client_dashboard/edit_appointment/'.$appointment->id) ?>" class="btn-edit">Editar</a>
                            <a href="<?= site_url('client_dashboard/cancel_appointment/'.$appointment->id) ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja cancelar este agendamento?')">Cancelar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="../js/navbar.js"></script>
</body>
</html>
