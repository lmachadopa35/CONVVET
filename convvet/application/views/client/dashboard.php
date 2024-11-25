<!-- Listagem de Pets -->
<ul class="list-group">
    <?php foreach ($pets as $pet): ?>
        <li class="list-group-item">
            <strong>Nome:</strong> <?= $pet->name ?><br>
            <strong>Tipo:</strong> <?= $pet->type ?><br>
            <strong>Raça:</strong> <?= $pet->breed ?><br>
            <strong>Idade:</strong> <?= $pet->age ?> anos<br>

            <!-- Links para editar e excluir -->
            <a href="<?= site_url('client/dashboard/edit_pet/'.$pet->id); ?>" class="btn btn-warning btn-sm mt-2">Editar</a>
            <a href="<?= site_url('client/dashboard/delete_pet/'.$pet->id); ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Tem certeza que deseja excluir este pet?')">Excluir</a>
        </li>
    <?php endforeach; ?>
</ul>

<a href='../dashboard/create_pet'>A<a>