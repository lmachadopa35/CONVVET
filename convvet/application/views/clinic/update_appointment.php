<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
</head>
<body>

    <h1>Editar Agendamento</h1>

    <?php echo form_open('client/update_appointment/' . $appointment['id']); ?>

    <label for="clinic_id">Clínica:</label>
    <select name="clinic_id" id="clinic_id">
        <?php foreach ($clinics as $clinic): ?>
            <option value="<?= $clinic['id']; ?>" <?= ($clinic['id'] == $appointment['clinic_id']) ? 'selected' : ''; ?>>
                <?= $clinic['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="pet_id">Pet:</label>
    <select name="pet_id" id="pet_id">
        <?php foreach ($pets as $pet): ?>
            <option value="<?= $pet['id']; ?>" <?= ($pet['id'] == $appointment['pet_id']) ? 'selected' : ''; ?>>
                <?= $pet['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="description">Descrição:</label>
    <textarea name="description" id="description"><?= $appointment['description']; ?></textarea>

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="pendente" <?= ($appointment['status'] == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
        <option value="atendido" <?= ($appointment['status'] == 'atendido') ? 'selected' : ''; ?>>Atendido</option>
        <option value="cancelado" <?= ($appointment['status'] == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
    </select>

    <button type="submit">Salvar Alterações</button>

    <?php echo form_close(); ?>

    <script src="../js/navbar.js"></script>
</body>
</html>
