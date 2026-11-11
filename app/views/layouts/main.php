<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Projeto MVC') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="<?= asset('img/logo.png') ?>">
    <link rel="stylesheet" href="<?= asset('css/estilos.css') ?>">
</head>
<body>
    <header class="topo mb-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="<?= asset('img/logo.png') ?>" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                    Projeto MVC
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?= url('usuario/index') ?>">Usuários</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= url('refeicao/index') ?>">Refeições</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= url('medicamento/index') ?>">Medicamentos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= url('exercicio/index') ?>">Exercícios</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= url('consulta/index') ?>">Consultas</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="container">
        <?= $content ?>
    </main>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('js/app.js') ?>" defer></script>
</body>
</html>
