<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1><?= e($title ?? 'Consultas Médicas') ?></h1>
        <a href="<?= e(url('consulta/create')) ?>" class="btn btn-primary">+ Nova Consulta</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <p class="mb-0">
                Página inicial de <strong>Consultas Médicas</strong> integrada ao template Bootstrap (Entrega 11/11).
            </p>
        </div>
    </div>
</div>