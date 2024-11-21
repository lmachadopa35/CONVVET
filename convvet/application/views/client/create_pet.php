<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pet</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3 class="text-center">Cadastro de Pet</h3>

            <?php echo validation_errors(); ?>

            <form action="<?= site_url('client/dashboard/store_pet'); ?>" method="POST">
                <div class="form-group">
                    <label for="type">Tipo de Animal</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="">Selecione</option>
                        <option value="Cachorro">Cachorro</option>
                        <option value="Gato">Gato</option>
                        <option value="Pássaro">Pássaro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nome do Pet</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Nome do pet">
                </div>
                <div class="form-group">
                    <label for="breed">Raça</label>
                    <input type="text" class="form-control" id="breed" name="breed" required placeholder="Raça do pet">
                </div>
                <div class="form-group">
                    <label for="age">Idade (em anos)</label>
                    <input type="number" class="form-control" id="age" name="age" required placeholder="Idade do pet" min="0">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Cadastrar Pet</button>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
