<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergências</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/emergencies.css">
</head>

<body>


    <div class="emergencies-container">
        <div class="emergencies-list">
            <?php if (!empty($emergencies)): ?>
                <?php foreach ($emergencies as $emergency): ?>
                    <div class="emergency-card">
                        <h3 class="emergency-title">Emergência #<?= $emergency['id'] ?></h3>
                        <p><strong>Pet:</strong> <?= htmlspecialchars($emergency['pet_name']) ?></p>
                        <p><strong>Tipo:</strong> <?= htmlspecialchars($emergency['pet_type']) ?></p>
                        <p><strong>Raça:</strong> <?= htmlspecialchars($emergency['breed']) ?></p>
                        <p><strong>Idade:</strong> <?= htmlspecialchars($emergency['age']) ?> anos</p>
                        <p><strong>Descrição:</strong> <?= htmlspecialchars($emergency['description']) ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars($emergency['status']) ?></p>
                        <div class="action-buttons">
                            <form action="<?= site_url('clinic_dashboard/update_emergency/' . $emergency['id']); ?>" method="post">
                                <select name="status" class="status-dropdown">
                                    <option value="pendente" <?= ($emergency['status'] == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                                    <option value="em atendimento" <?= ($emergency['status'] == 'em atendimento') ? 'selected' : '' ?>>Em Atendimento</option>
                                    <option value="atendido" <?= ($emergency['status'] == 'atendido') ? 'selected' : '' ?>>Atendido</option>
                                </select>
                                <button type="submit" class="btn-update">Atualizar Status</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-emergencies">Nenhuma emergência encontrada.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="../js/navbar.js"></script>
</body>
</html>
