<?php foreach ($appointments as $appointment): ?>
    <tr>
        <td><?= $appointment['id'] ?></td>
        <td><?= $appointment['name'] ?></td>
        <td><?= $appointment['status'] ?></td>
        <td>
            <a href="<?= site_url('controller_name/update_status/' . $appointment['id'] . '/atendido') ?>" class="btn btn-success">Atendido</a>
            <a href="<?= site_url('controller_name/update_status/' . $appointment['id'] . '/rejeitado') ?>" class="btn btn-danger">Rejeitado</a>
            <a href="<?= site_url('controller_name/update_status/' . $appointment['id'] . '/cancelado') ?>" class="btn btn-warning">Cancelado</a>
        </td>
    </tr>
<?php endforeach; ?>
