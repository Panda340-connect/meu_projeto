<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Bem Viver - Início') ?></title>
    <!-- Bootstrap 5 CSS e Bootstrap Icons -->
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
        .navbar-bemviver .nav-link:hover,
        .navbar-bemviver .nav-link.active {
            border-bottom: 3px solid #ffffff;
        }
        .titulo-boasvindas {
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
        .btn-verde {
            background-color: #3b8754;
            color: #fff;
            font-weight: 600;
        }
        .btn-verde:hover {
            background-color: #2e6b42;
            color: #fff;
        }
    </style>
</head>
<body id="pagina-idoso">

    <!-- Barra Superior Verde Bem Viver -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-bemviver shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 d-flex align-items-center gap-2" href="<?= url('consulta/index') ?>">
                <i class="bi bi-heart-fill text-white"></i> Bem Viver
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuBemViver">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuBemViver">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="<?= url('consulta/index') ?>">INÍCIO</a></li>
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
                    <a href="<?= url('usuario/index') ?>" class="btn btn-warning btn-sm fw-bold text-white px-3" style="background-color: #e69500; border: none;">SAIR</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo da Página -->
    <main class="container py-4">
        <?php
        if (isset($content)) {
            echo $content;
        } elseif (isset($viewFile) && file_exists($viewFile)) {
            require $viewFile;
        }
        ?>
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