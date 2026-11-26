<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Bem Viver') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="<?= asset('img/logo.png') ?>">
    <link rel="stylesheet" href="<?= asset('css/estilo.css') ?>">
</head>
<body>
    <header class="topo mb-4">
        <div class="acessibilidade-barra">
            <span>Tamanho da fonte:</span>
            <button type="button" id="btn-fonte-menos" class="btn-fonte" aria-label="Diminuir tamanho da fonte">A-</button>
            <button type="button" id="btn-fonte-mais" class="btn-fonte" aria-label="Aumentar tamanho da fonte">A+</button>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= url('exercicio/index') ?>">
                    <img src="<?= asset('img/logo.png') ?>" alt="Logo Bem Viver" width="32" height="32" class="d-inline-block align-text-top me-2">
                    Bem Viver
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menuPrincipal">
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
        <?= $content ?? '' ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('js/app.js') ?>" defer></script>
</body>
</html>
