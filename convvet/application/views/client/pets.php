<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/pets.css">
    <style>
    .container textarea {
        width: 90%;
    }

    .icon-container {
        width: 100px;
        height: 100px;
        border: 4px solid #4CAF50;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .icon-container:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .icon-container:active {
        transform: scale(1.05);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    }

    .icon-plus {
        width: 60px;
        height: 60px;
        position: relative;
    }

    .icon-plus::before,
    .icon-plus::after {
        content: '';
        position: absolute;
        background-color: #4CAF50;
        border-radius: 4px;
    }

    .icon-plus::before {
        width: 60px;
        height: 10px;
        top: 25px;
        left: 0;
    }

    .icon-plus::after {
        width: 10px;
        height: 60px;
        top: 0;
        left: 25px;
    }
    </style>
</head>

<body>


    <div class="pets-container">
        <div class="pets-list">
            <!-- Na view 'client/pets.php' -->
            <?php if (!empty($pets)) : ?>
            <?php foreach ($pets as $pet) : ?>
            <div class="pet-card">
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($pet->name); ?></p>
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($pet->type); ?></p>
                <p><strong>Raça:</strong> <?php echo htmlspecialchars($pet->breed); ?></p>
                <p><strong>Idade:</strong> <?php echo htmlspecialchars($pet->age); ?> anos</p>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>Não há pets cadastrados.</p>
            <?php endif; ?>



            <div style="background: transparent; border: none; box-shadow: none; display: flex; justify-content: center; align-items: center;"
                class="pet-card">
                <a href="../client_dashboard/create_pet">
                    <div class="icon-container" "><div class=" icon-plus"></div>
                </a>
            </div>
        </div>
    </div>
    </div>

    </div>
    <script src="<?= base_url('../js/navbar.js'); ?>"></script>
</body>

</html>