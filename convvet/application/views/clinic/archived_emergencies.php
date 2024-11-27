<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergências Arquivadas</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <style>
        /* Estilos básicos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            color: #333;
        }

        .archived-emergencies-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        .emergencies-list {
            display: grid;
            gap: 20px;
        }

        .emergency-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .emergency-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .emergency-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            margin-bottom: 8px;
        }

        p strong {
            color: #444;
        }

        .no-emergencies {
            text-align: center;
            font-size: 1.2rem;
            color: #888;
            padding: 20px;
        }
    </style>
</head>
<body>


    <div class="archived-emergencies-container">
        <h1>Emergências Arquivadas</h1>
        <div class="emergencies-list">
            <?php if (!empty($archived_emergencies)): ?>
                <?php foreach ($archived_emergencies as $emergency): ?>
                    <div class="emergency-card">
                        <h3 class="emergency-title">Emergência #<?= htmlspecialchars($emergency['id']) ?></h3>
                        <p><strong>Pet:</strong> <?= isset($emergency['pet_name']) ? htmlspecialchars($emergency['pet_name']) : 'Não informado' ?></p>
                        <p><strong>Tipo:</strong> <?= isset($emergency['pet_type']) ? htmlspecialchars($emergency['pet_type']) : 'Não informado' ?></p>
                        <p><strong>Raça:</strong> <?= isset($emergency['breed']) ? htmlspecialchars($emergency['breed']) : 'Não informado' ?></p>
                        <p><strong>Idade:</strong> <?= isset($emergency['age']) ? htmlspecialchars($emergency['age']) . ' anos' : 'Não informado' ?></p>
                        <p><strong>Descrição:</strong> <?= htmlspecialchars($emergency['description']) ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars($emergency['status']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-emergencies">Nenhuma emergência arquivada.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="../js/navbar.js"></script>
</body>
</html>
