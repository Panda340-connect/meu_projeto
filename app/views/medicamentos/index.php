<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= e($title ?? 'Medicamentos') ?></h1>
    <a href="<?= e(url('medicamento/create')) ?>" class="btn btn-primary">Novo Medicamento</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Medicamento</th>
                <th>Dosagem</th>
                <th>Horário</th>
                <th>Frequência</th>
                <th>Usuário</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($medicamentos)): ?>
                <?php foreach ($medicamentos as $medicamento): ?>
                    <tr>
                        <td><?= e($medicamento['id_medicamento']) ?></td>
                        <td><?= e($medicamento['nome_medicamento']) ?></td>
                        <td><?= e($medicamento['dosagem']) ?></td>
                        <td><?= e($medicamento['horario']) ?></td>
                        <td><?= e($medicamento['frequencia']) ?></td>
                        <td><?= e($medicamento['nome_usuario'] ?? $medicamento['id_usuario']) ?></td>
                        <td class="text-center text-nowrap">
                            <a href="<?= e(url('medicamento/edit/' . $medicamento['id_medicamento'])) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <form action="<?= e(url('medicamento/delete/' . $medicamento['id_medicamento'])) ?>" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este medicamento?');">
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Nenhum medicamento cadastrado até o momento.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>