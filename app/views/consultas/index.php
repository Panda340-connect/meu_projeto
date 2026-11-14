<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Consultas Médicas Agendadas</h2>
        <a href="<?= url('consulta/create') ?>" class="btn btn-primary btn-lg">
            + Agendar Consulta
        </a>
    </div>

    <?php if (empty($consultas)): ?>
        <div class="alert alert-info fs-5">
            Nenhuma consulta cadastrada no momento.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle fs-5">
                <thead class="table-dark">
                    <tr>
                        <th>Usuário</th>
                        <th>Especialidade</th>
                        <th>Médico(a)</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Local</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $c): ?>
                        <tr>
                            <td><?= e($c['nome_usuario'] ?? '') ?></td>
                            <td><?= e($c['especialidade'] ?? '') ?></td>
                            <td><?= e($c['nome_medico'] ?? '') ?></td>
                            <td><?= !empty($c['data_consulta']) ? date('d/m/Y', strtotime($c['data_consulta'])) : '' ?></td>
                            <td><?= !empty($c['horario']) ? substr($c['horario'], 0, 5) : '' ?></td>
                            <td><?= e($c['local'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>