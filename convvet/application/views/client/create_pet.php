<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Client - CONVVET</title>
    <link rel="stylesheet" href="../css/navbar.css">
    
    <link rel="stylesheet" href="../css/cadastros.css">
    <link rel="stylesheet" href="../css/pets.css">
<style>
    input[type="text"],
input[type="password"],
input[type="email"],
input[type="tel"],
input[type="number"]{
    width: 95%;
}
select{width: 100%;}
</style>

</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <?php echo validation_errors(); ?>

                <form action="<?= site_url('client_dashboard/store_pet'); ?>" method="POST">
                    <div class="form-group">
                        
                        <select class="form-control" id="type" name="type" required>
                            <option value="">Selecione</option>
                            <option value="Cachorro">Cachorro</option>
                            <option value="Gato">Gato</option>
                            <option value="Pássaro">Pássaro</option>
                        </select>
                    </div>
                    <div class="form-group">
                       
                        <input type="text" class="form-control" id="name" name="name" required
                            placeholder="Nome do pet">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="breed" name="breed" required
                            placeholder="Raça do pet">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="age" name="age" required
                            placeholder="Idade do pet" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Cadastrar Pet</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../js/navbar.js"></script>
</body>



</html>