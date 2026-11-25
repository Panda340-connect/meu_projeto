<div class="d-flex justify-content-between align-items-center mb-3">
    <h1><?= e($title ?? 'Listagem de Exercícios') ?></h1>
    <a href="<?= url('exercicio/create') ?>" class="btn btn-primary">Novo Exercício</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>ID Usuário</th>
                <th>Descrição</th>
                <th>Frequência</th>
                <th>Duração</th>
                <th>Data</th>
                <th>Horário</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($exercicios)): ?>
                <?php foreach ($exercicios as $exercicio): ?>
                    <tr>
                        <td><?= e($exercicio['nome'] ?? '') ?></td>
                        <td><?= e($exercicio['id_usuario'] ?? '') ?></td>
                        <td><?= e($exercicio['descricao'] ?? '') ?></td>
                        <td><?= e($exercicio['frequencia'] ?? '') ?></td>
                        <td><?= e($exercicio['duracao'] ?? '') ?></td>
                        <td><?= e($exercicio['data_exercicio'] ?? '') ?></td>
                        <td><?= e($exercicio['horario'] ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Nenhum exercício cadastrado ainda.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
