<?php
$title = $title ?? 'Contatos e Usuários';
$usuarios = $usuarios ?? [];

$normalizar = static function (?string $texto): string {
    $limpo = trim((string) $texto);
    return function_exists('mb_strtolower') ? mb_strtolower($limpo, 'UTF-8') : strtolower($limpo);
};

$blocos = [
    'idoso' => [
        'titulo' => 'Idosos',
        'estilo' => 'background-color: #e6f4ea; color: #1b4332;',
    ],
    'cuidador' => [
        'titulo' => 'Cuidadores',
        'estilo' => 'background-color: #e8f1fb; color: #1d3557;',
    ],
    'familiar' => [
        'titulo' => 'Familiares',
        'estilo' => 'background-color: #fef3e2; color: #6c4308;',
    ],
    'administrador' => [
        'titulo' => 'Administradores',
        'estilo' => 'background-color: #eef0f4; color: #2b3440;',
    ],
];

$agrupados = [];
foreach (array_keys($blocos) as $chave) {
    $agrupados[$chave] = [];
}
$outros = [];

foreach ($usuarios as $u) {
    $tipo = $normalizar($u['tipo_usuario'] ?? '');
    if (isset($agrupados[$tipo])) {
        $agrupados[$tipo][] = $u;
    } else {
        $outros[] = $u;
    }
}
?>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h1 class="h3 fw-bold text-primary mb-0"><?= e($title) ?></h1>
            <a href="<?= e(url('usuario/create')) ?>" class="btn btn-success fw-semibold">
                + Novo Usuário
            </a>
        </div>

        <div class="row g-4">
            <?php foreach ($blocos as $chave => $config): ?>
                <div class="col-12 col-lg-6">
                    <div class="card h-100 border rounded-3 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center fw-bold" style="<?= $config['estilo'] ?>">
                            <span><?= e($config['titulo']) ?></span>
                            <span class="badge bg-white text-dark border"><?= count($agrupados[$chave]) ?></span>
                        </div>

                        <?php if (empty($agrupados[$chave])): ?>
                            <div class="card-body text-muted text-center py-4">
                                Nenhum registro neste grupo.
                            </div>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($agrupados[$chave] as $u): ?>
                                    <?php $telefone = trim((string) ($u['telefone'] ?? '')); ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center gap-2 py-3">
                                        <div>
                                            <div class="fw-bold fs-6"><?= e($u['nome'] ?? '') ?></div>
                                            <div class="text-dark">
                                                <strong>Tel:</strong> <?= e($telefone !== '' ? $telefone : 'Não informado') ?>
                                            </div>
                                            <div class="small text-muted"><?= e($u['email'] ?? '') ?></div>
                                        </div>
                                        <div class="d-flex gap-1 flex-shrink-0">
                                            <a href="<?= e(url('usuario/edit/' . (int) ($u['id_usuario'] ?? 0))) ?>" class="btn btn-warning btn-sm fw-semibold">
                                                Editar
                                            </a>
                                            <a href="<?= e(url('usuario/delete/' . (int) ($u['id_usuario'] ?? 0))) ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Tem certeza que deseja excluir?')">
                                                Excluir
                                            </a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (!empty($outros)): ?>
                <div class="col-12">
                    <div class="card border rounded-3 shadow-sm">
                        <div class="card-header fw-bold" style="background-color: #f1f3f5; color: #343a40;">
                            Outros Perfis
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($outros as $u): ?>
                                <?php $telefone = trim((string) ($u['telefone'] ?? '')); ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center gap-2 py-3">
                                    <div>
                                        <div class="fw-bold">
                                            <?= e($u['nome'] ?? '') ?>
                                            <span class="badge bg-light text-dark border ms-1"><?= e($u['tipo_usuario'] ?? 'Sem tipo') ?></span>
                                        </div>
                                        <div>
                                            <strong>Tel:</strong> <?= e($telefone !== '' ? $telefone : 'Não informado') ?>
                                        </div>
                                        <div class="small text-muted"><?= e($u['email'] ?? '') ?></div>
                                    </div>
                                    <div class="d-flex gap-1 flex-shrink-0">
                                        <a href="<?= e(url('usuario/edit/' . (int) ($u['id_usuario'] ?? 0))) ?>" class="btn btn-warning btn-sm fw-semibold">Editar</a>
                                        <a href="<?= e(url('usuario/delete/' . (int) ($u['id_usuario'] ?? 0))) ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>