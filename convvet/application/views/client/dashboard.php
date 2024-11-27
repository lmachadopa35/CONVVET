<!-- Listagem de Pets -->
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Client - CONVVET</title>
    <link rel="stylesheet" href="<?= base_url('../css/styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('../css/navbar.css'); ?>">


</head>

<body class="home">

<div class="menu">
      <img id="logo" class="logo-image" src="<?= base_url('/assets/convvet.png'); ?>" alt="Logo">
  </div>



    <div class="container">
        <div class="grid-container">
            <a href="/client_dashboard/create_appointment">
                <div class="grid-item">Agendar Consulta (Online)</div>
            </a>
            <a href="/client_dashboard/appointments">
                <div class="grid-item">Agendamentos</div>
            </a>
            <a href="/client_dashboard/list_clinics">
                <div class="grid-item">Clinicas Próximas</div>
            </a>
            <a href="/SACController/index">
                <div class="grid-item">SAC</div>
            </a>
            <a href="/client_dashboard/create_emergency">
                <div style="width: 420px;" class="grid-item">EMERGÊNCIA</div>
            </a>
            

        </div>
    </div>
    <script src="<?= base_url('../js/navbar.js'); ?>"></script>
</body>

</html>