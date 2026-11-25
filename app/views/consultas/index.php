<?php $consultas = $consultas ?? []; ?>

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
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $c): ?>
                    <?php $id = (int) ($c['id_consulta'] ?? 0); ?>
                    <tr>
                        <td class="fw-semibold"><?= e($c['nome_usuario'] ?? '') ?></td>
                        <td><?= e($c['especialidade'] ?? '') ?></td>
                        <td><?= e($c['nome_medico'] ?? '') ?></td>
                        <td><?= format_date($c['data_consulta'] ?? null) ?></td>
                        <td><?= format_time($c['horario'] ?? null) ?></td>
                        <td><?= e($c['local'] ?? '') ?></td>
                        <td class="text-center text-nowrap">
                            <a href="<?= url('consulta/edit/' . $id) ?>" class="btn btn-warning btn-sm fw-semibold me-1">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </a>
                            <form method="post"
                                  action="<?= url('consulta/delete/' . $id) ?>"
                                  class="d-inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir esta consulta?');">
                                <input type="hidden" name="id_consulta" value="<?= $id ?>">
                                <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                                    <i class="bi bi-trash-fill"></i> Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>