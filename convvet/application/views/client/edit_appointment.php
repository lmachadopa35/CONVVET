<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="<?= base_url('../css/styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('../css/navbar.css'); ?>">    

<style>

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        margin: 0;
        padding: 0;
        display: block;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>Editar Agendamento</h2>
        <form action="<?= site_url('client_dashboard/update_appointment/'.$appointment->id); ?>" method="POST">
            <div class="form-group">
                <label for="clinic_id">Selecione a Clínica</label>
            <select class="form-control" id="clinic_id" name="clinic_id" required>
                    <?php foreach ($clinics as $clinic): ?>
                    <option value="<?= $clinic->id ?>"
                        <?= ($clinic->id == $appointment->clinic_id) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($clinic->name); ?>
                    </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="form-group">
                <label for="pet_id">Selecione o Pet</label>
            <select class="form-control" id="pet_id" name="pet_id" required>
                    <?php foreach ($pets as $pet): ?>
                    <option value="<?= $pet->id ?>" <?= ($pet->id == $appointment->pet_id) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($pet->name); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>




            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" name="description"
                    required><?= htmlspecialchars($appointment->description) ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="pendente" <?= $appointment->status == 'pendente' ? 'selected' : ''; ?>>Pendente
                    </option>
                    <option value="atendido" <?= $appointment->status == 'atendido' ? 'selected' : ''; ?>>Atendido
                    </option>
                    <option value="cancelado" <?= $appointment->status == 'cancelado' ? 'selected' : ''; ?>>Cancelado
                    </option>
                </select>
            </div>

            <button type="submit" class="btn">Atualizar Agendamento</button>
        </form>
    </div>
    <script src="<?= base_url('../js/navbar.js'); ?>"></script>
</body>

</html>