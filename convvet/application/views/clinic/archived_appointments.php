<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soluções Arquivadas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="appointments-container">
        <h3>Soluções Arquivadas</h3>
        <?php if (!empty($archivedAppointments)): ?>
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Data Arquivamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($archivedAppointments as $appointment): ?>
                        <tr>
                            <td><?= isset($appointment['user_id']) ? htmlspecialchars($appointment['user_id']) : 'Não informado' ?></td>
                            <td><?= isset($appointment['type']) ? htmlspecialchars($appointment['type']) : 'Não informado' ?></td>
                            <td><?= isset($appointment['description']) ? htmlspecialchars($appointment['description']) : 'Não informado' ?></td>
                            <td><?= isset($appointment['status']) ? htmlspecialchars($appointment['status']) : 'Não informado' ?></td>
                            <td><?= isset($appointment['archived_at']) ? htmlspecialchars($appointment['archived_at']) : 'Não informado' ?></td>
                            <td>
                                <a href="<?= site_url('clinic/update_status/'.$appointment['id'].'/atendido') ?>">Atender</a>
                                <a href="<?= site_url('clinic/update_status/'.$appointment['id'].'/rejeitado') ?>">Rejeitar</a>
                                <a href="<?= site_url('clinic/update_status/'.$appointment['id'].'/cancelado') ?>">Cancelar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-appointments">Nenhuma solução arquivada no momento.</p>
        <?php endif; ?>
    </div>
</body>
</html>
