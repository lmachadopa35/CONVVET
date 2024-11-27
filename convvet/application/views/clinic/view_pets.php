<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pets</title>
    
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #777;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #9e55fd;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        p {
            text-align: center;
            font-size: 1.2em;
            color: #555;
        }
    </style>
</head>
<body>


    <h1>Lista de Pets</h1>

    <?php if(!empty($pets)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nome</th>
                    <th>Raça</th>
                    <th>Idade</th>
                    <th>Nome do Dono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pets as $pet): ?>
                    <tr>
                        <td><?php echo $pet->id; ?></td>
                        <td><?php echo $pet->type; ?></td>
                        <td><?php echo $pet->pet_name; ?></td>
                        <td><?php echo $pet->breed; ?></td>
                        <td><?php echo $pet->age; ?></td>
                        <td><?php echo $pet->user_name; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Não há pets cadastrados.</p>
    <?php endif; ?>

    <script src="../js/navbar.js"></script>
</body>
</html>
