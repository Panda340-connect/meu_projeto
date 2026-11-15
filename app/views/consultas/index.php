<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="titulo-boasvindas mb-0">
        <i class="bi bi-calendar2-check me-2"></i>Consultas Médicas Agendadas
    </h3>
    <a href="<?= url('consulta/create') ?>" class="btn btn-verde btn-lg">
        + Agendar Consulta
    </a>
</div>

<?php if (empty($consultas)): ?>
    <div class="alert alert-info fs-5 mb-0">
        Nenhuma consulta cadastrada no momento. Clique em <strong>+ Agendar Consulta</strong> para cadastrar.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover align-middle fs-5 mb-0">
            <thead class="table-success">
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
                        <td class="fw-semibold"><?= e($c['nome_usuario'] ?? '') ?></td>
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