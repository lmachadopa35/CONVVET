<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Emergência</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/styles.css">
 <style>
    /* Estilo do container do formulário */
    .body2 {
        display: grid;

        align-items: center;
        min-height: 90vh;
        font-family: Arial, Helvetica, sans-serif;
    }

    .emergency-form-container {
        width: 50%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
    }

    .success-message {
        color: green;
        font-weight: bold;
        text-align: center;
        margin-bottom: 15px;
    }

    .emergency-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    label {
        font-size: 1rem;
        color: #333;
    }

    select,
    textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
        outline: none;
        transition: border 0.3s ease;
    }

    select:focus,
    textarea:focus {
        border-color: #9e53f7;
    }

    textarea {
        min-height: 150px;
        resize: vertical;
    }

    button {
        padding: 12px 25px;
        background-color: #9e53f7;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #944fe8;
    }
    </style>
</head>

<body>

    <div class="body2">
    <div class="emergency-form-container">
        <h2 class="form-title">Criar Emergência</h2>

        <!-- Mensagem de sucesso -->
        <?php if ($this->session->flashdata('success')): ?>
        <p class="success-message"><?= $this->session->flashdata('success'); ?></p>
        <?php endif; ?>

        <!-- Exibição de erros de validação -->
        <?php echo validation_errors(); ?>

        <!-- Formulário de emergência -->
        <form action="<?= site_url('client_dashboard/submit_emergency'); ?>" method="post" class="emergency-form">

            <!-- Escolher clínica -->
            <div class="form-group">
                <label for="clinic_id">Escolha a clínica:</label>
                <select name="clinic_id" id="clinic_id">
                    <?php foreach ($clinics as $clinic): ?>
                    <option value="<?= $clinic['id'] ?>"><?= $clinic['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Escolher Pet -->
            <div class="form-group">
                <label for="pet_id">Escolha o Pet:</label>
                <select name="pet_id" id="pet_id">
                    <?php if (!empty($pets)): ?>
                    <?php foreach ($pets as $pet): ?>
                    <option value="<?= htmlspecialchars($pet->id) ?>"><?= htmlspecialchars($pet->name) ?> -
                        <?= htmlspecialchars($pet->type) ?> (<?= htmlspecialchars($pet->breed) ?>, <?= $pet->age ?>
                        anos)</option>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <option value="">Nenhum pet encontrado</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Descrição -->
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description"
                    placeholder="Descreva a situação de emergência..."></textarea>
            </div>

            <!-- Botão de envio -->
            <div class="form-group">
                <button type="submit" class="btn-submit">Enviar Emergência</button>
            </div>
        </form>
    </div></div>
    <script src="../js/navbar.js"></script>
</body>

</html>