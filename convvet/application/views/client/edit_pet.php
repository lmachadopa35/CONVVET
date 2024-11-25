<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pet</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3 class="text-center">Editar Pet</h3>

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
                <button type="submit" class="btn btn-primary btn-block">Atualizar Pet</button>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
