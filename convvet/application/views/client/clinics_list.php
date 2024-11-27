<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clínicas</title>
    <link rel="stylesheet" href="<?= base_url('../css/styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('../css/navbar.css'); ?>">


    <style>
    /* Estilos principais */
    .clinic-list-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .clinic-list-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
        color: #333;
    }

    .clinic-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .clinic-card {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .clinic-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .clinic-name {
        font-size: 1.5rem;
        font-weight: bold;
        color: #444;
        margin-bottom: 10px;
    }

    .clinic-card p {
        font-size: 1rem;
        color: #666;
        margin-bottom: 10px;
    }

    .no-clinics {
        text-align: center;
        font-size: 1.2rem;
        color: #888;
    }
    </style>
</head>

<body>
<button class="open-btn" id="open-btn">&#9776;</button>
    <div id="navbar-container"></div>
    <script src="/js/navbar.js"></script>
    <div class="clinic-list-container">
        <h1 class="clinic-list-title">Lista de Clínicas</h1>

        <?php if (!empty($clinics)): ?>
        <div class="clinic-list">
            <?php foreach ($clinics as $clinic): ?>
            <div class="clinic-card">
                <h3 class="clinic-name"><?= htmlspecialchars($clinic->name) ?></h3>
                <p><strong>Email:</strong> <?= htmlspecialchars($clinic->email) ?></p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($clinic->phone) ?></p>
                <p><strong>Endereco Fisico:</strong> <?= htmlspecialchars($clinic->address) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="no-clinics">Nenhuma clínica encontrada.</p>
        <?php endif; ?>
    </div>
    <script src="../js/navbar.js"></script>
</body>

</html>