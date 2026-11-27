<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Bem Viver - Agenda Digital do Idoso') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f4ee;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-bemviver {
            background: linear-gradient(90deg, #558736 0%, #689f38 100%);
        }
        .navbar-bemviver .nav-link {
            color: #ffffff !important;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            padding: 0.5rem 0.85rem !important;
        }
        .navbar-bemviver .nav-link:hover {
            border-bottom: 3px solid #ffffff;
        }
        .titulo-boasvindas, main h1, main h2, main h3 {
            color: #165689;
            font-weight: 700;
        }
        .card-bemviver {
            background-color: #f8f9f5;
            border: 1px solid #dcdfe6;
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-bemviver:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }
        .icone-card {
            font-size: 2.8rem;
            color: #2c3a47;
        }
        .btn-verde, main button[type="submit"]:not(.btn) {
            background-color: #3b8754;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.2rem;
        }
        .btn-verde:hover, main button[type="submit"]:not(.btn):hover {
            background-color: #2e6b42;
            color: #fff;
        }
        /* Estiliza automaticamente tabelas e formulários simples das outras colegas */
        main table:not(.table) {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
            margin-top: 1rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        main table:not(.table) th {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 12px 16px;
            text-align: left;
        }
        main table:not(.table) td {
            padding: 12px 16px;
            border-top: 1px solid #dee2e6;
        }
        main input:not(.form-control), main select:not(.form-select) {
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            margin-top: 0.25rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }
    </style>
</head>
<body id="pagina-idoso">

    <!-- Barra Superior Verde Bem Viver em todas as páginas -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-bemviver shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 d-flex align-items-center gap-2" href="<?= url('') ?>">
                <i class="bi bi-heart-fill text-white"></i> Bem Viver
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuBemViver">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuBemViver">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="<?= url('') ?>">INÍCIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('refeicao/index') ?>">MINHA AGENDA</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('medicamento/index') ?>">MEDICAMENTOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('consulta/index') ?>">CONSULTAS</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('exercicio/index') ?>">EXERCÍCIOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('usuario/index') ?>">CONTATOS</a></li>
                </ul>

                <div class="d-flex align-items-center gap-2 text-white">
                    <button type="button" onclick="alterarFonte(1)" class="btn btn-outline-light btn-sm fw-bold px-2">A+</button>
                    <button type="button" onclick="alterarFonte(-1)" class="btn btn-outline-light btn-sm fw-bold px-2">A-</button>
                    <span class="ms-2 fw-semibold">Olá, Maria!</span>
                    <a href="<?= url('') ?>" class="btn btn-warning btn-sm fw-bold text-white px-3" style="background-color: #e69500; border: none;">SAIR</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <?php
        $uriAtual = $_SERVER['REQUEST_URI'] ?? '';
        $ehPaginaInicial = !preg_match('#/(usuario|consulta|medicamento|refeicao|exercicio)#i', $uriAtual);
        ?>

        <?php if ($ehPaginaInicial): ?>
            <!-- Tela Inicial de Boas-Vindas (abre em localhost/meu_projeto/) -->
            <div class="mb-4">
                <h1 class="titulo-boasvindas display-6">Olá, Maria! Bem-vinda ao Bem Viver.</h1>
                <p class="text-secondary fs-5 mb-0">Organize sua rotina de forma simples e segura.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
                <div class="col">
                    <div class="card card-bemviver h-100 text-center p-4">
                        <div class="mb-2"><i class="bi bi-capsule icone-card"></i></div>
                        <h4 class="fw-bold">Meus Medicamentos</h4>
                        <p class="text-muted">Organize seus horários e doses de remédios.</p>
                        <div class="mt-auto">
                            <a href="<?= url('medicamento/index') ?>" class="btn btn-verde px-4 py-2">Ver Remédios</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-bemviver h-100 text-center p-4">
                        <div class="mb-2"><i class="bi bi-heart-pulse icone-card"></i></div>
                        <h4 class="fw-bold">Minhas Consultas</h4>
                        <p class="text-muted">Organize a rotina de suas consultas médicas.</p>
                        <div class="mt-auto">
                            <a href="<?= url('consulta/index') ?>" class="btn btn-verde px-4 py-2">Ver Consultas</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-bemviver h-100 text-center p-4">
                        <div class="mb-2"><i class="bi bi-person-walking icone-card"></i></div>
                        <h4 class="fw-bold">Meus Exercícios</h4>
                        <p class="text-muted">Acompanhe sua rotina de exercícios diários.</p>
                        <div class="mt-auto">
                            <a href="<?= url('exercicio/index') ?>" class="btn btn-verde px-4 py-2">Ver Exercícios</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-bemviver h-100 text-center p-4">
                        <div class="mb-2"><i class="bi bi-telephone-fill icone-card"></i></div>
                        <h4 class="fw-bold">Contatos Rápidos</h4>
                        <p class="text-muted">Contatos rápidos e cadastro de usuários.</p>
                        <div class="mt-auto">
                            <a href="<?= url('usuario/index') ?>" class="btn btn-danger fw-semibold px-4 py-2">Ver Contatos</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-bemviver h-100 text-center p-4">
                        <div class="mb-2"><i class="bi bi-file-earmark-text icone-card"></i></div>
                        <h4 class="fw-bold">Minha Agenda / Refeições</h4>
                        <p class="text-muted">Consultar cardápio diário e rotina alimentar.</p>
                        <div class="mt-auto">
                            <a href="<?= url('refeicao/index') ?>" class="btn btn-primary fw-semibold px-4 py-2">Consultar</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-bemviver h-100 text-center p-4">
                        <div class="mb-2"><i class="bi bi-bell-fill icone-card"></i></div>
                        <h4 class="fw-bold">Lembretes</h4>
                        <p class="text-muted">Agende novos lembretes de consultas médicas.</p>
                        <div class="mt-auto">
                            <a href="<?= url('consulta/create') ?>" class="btn btn-primary fw-semibold px-4 py-2">Ver Lembretes</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Conteúdo específico de cada módulo (Usuários, Consultas, Medicamentos, etc.) -->
            <div class="card card-bemviver p-4 shadow-sm">
                <?php
                if (isset($content)) {
                    echo $content;
                } elseif (isset($viewFile) && file_exists($viewFile)) {
                    require $viewFile;
                }
                ?>
            </div>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let tamanhoAtual = 100;
        function alterarFonte(direcao) {
            tamanhoAtual += direcao * 8;
            if (tamanhoAtual < 85) tamanhoAtual = 85;
            if (tamanhoAtual > 140) tamanhoAtual = 140;
            document.getElementById('pagina-idoso').style.fontSize = tamanhoAtual + '%';
        }
    </script>
</body>
</html>