<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pet</title>
    <link rel="stylesheet" href="<?= base_url('../css/styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('../css/navbar.css'); ?>">    

    <style>
        /* Reset básico de estilos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: auto;
        }

        h3 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            font-size: 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }


        @media (max-width: 576px) {
            .container {
                padding: 15px;
            }

            .open-btn {
                font-size: 1.3rem;
                padding: 12px;
            }
        }
    </style>

</head>

<body>

<button class="open-btn" id="open-btn">&#9776;</button>
    <div id="navbar-container"></div>
    <script src="/js/navbar.js"></script>

    <div class="container">
        <h3>Editar Pet</h3>

        <?php echo validation_errors(); ?>

        <form action="<?= site_url('client/dashboard/update_pet/'.$pet->id); ?>" method="POST">
            <div class="form-group">
                <label for="type">Tipo de Animal</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Cachorro" <?= $pet->type == 'Cachorro' ? 'selected' : ''; ?>>Cachorro</option>
                    <option value="Gato" <?= $pet->type == 'Gato' ? 'selected' : ''; ?>>Gato</option>
                    <option value="Pássaro" <?= $pet->type == 'Pássaro' ? 'selected' : ''; ?>>Pássaro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nome do Pet</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $pet->name ?>" required>
            </div>

            <div class="form-group">
                <label for="breed">Raça</label>
                <input type="text" class="form-control" id="breed" name="breed" value="<?= $pet->breed ?>" required>
            </div>

            <div class="form-group">
                <label for="age">Idade</label>
                <input type="number" class="form-control" id="age" name="age" value="<?= $pet->age ?>" required min="0">
            </div>

            <button type="submit" class="btn-primary">Atualizar Pet</button>
        </form>
    </div>
    <script src="<?= base_url('../js/navbar.js'); ?>"></script>
</body>

</html>
