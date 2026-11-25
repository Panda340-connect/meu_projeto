<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= e($title ?? 'Refeições') ?></h1>
    <a href="<?= e(url('refeicao/create')) ?>" class="btn btn-primary">Nova Refeição</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Refeição</th>
                <th>Descrição</th>
                <th>Horário</th>
                <th>Usuário</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($refeicoes)): ?>
                <?php foreach ($refeicoes as $refeicao): ?>
                    <tr>
                        <td><?= e($refeicao['id_refeicao']) ?></td>
                        <td><?= e($refeicao['nome_refeicao']) ?></td>
                        <td><?= e($refeicao['descricao']) ?></td>
                        <td><?= e($refeicao['horario']) ?></td>
                        <td><?= e($refeicao['nome_usuario'] ?? $refeicao['id_usuario']) ?></td>
                        <td class="text-center text-nowrap">
                            <a href="<?= e(url('refeicao/edit/' . $refeicao['id_refeicao'])) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <form action="<?= e(url('refeicao/delete/' . $refeicao['id_refeicao'])) ?>" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir esta refeição?');">
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Nenhuma refeição cadastrada até o momento.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>