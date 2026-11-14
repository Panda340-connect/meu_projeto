<div class="container mt-4">
    <h2 class="fw-bold mb-4">Agendar Nova Consulta</h2>

    <form method="post" action="<?= url('consulta/store') ?>" class="card p-4 shadow-sm fs-5">
        <div class="mb-3">
            <label class="form-label fw-bold">Idoso(a) / Usuário</label>
            <select name="id_usuario" class="form-select form-select-lg">
                <option value="">Selecione um usuário...</option>
                <?php foreach (($usuarios ?? []) as $u): ?>
                    <option value="<?= (int) $u['id_usuario'] ?>" 
                        <?= (($old['id_usuario'] ?? '') == $u['id_usuario']) ? 'selected' : '' ?>>
                        <?= e($u['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['id_usuario'])): ?>
                <div class="text-danger mt-1"><?= e($errors['id_usuario']) ?></div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Especialidade</label>
                <input type="text" name="especialidade" class="form-control form-control-lg" 
                       placeholder="Ex.: Cardiologia" value="<?= e($old['especialidade'] ?? '') ?>">
                <?php if (isset($errors['especialidade'])): ?>
                    <div class="text-danger mt-1"><?= e($errors['especialidade']) ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nome do(a) Médico(a)</label>
                <input type="text" name="nome_medico" class="form-control form-control-lg" 
                       placeholder="Ex.: Dr. Carlos Silva" value="<?= e($old['nome_medico'] ?? '') ?>">
                <?php if (isset($errors['nome_medico'])): ?>
                    <div class="text-danger mt-1"><?= e($errors['nome_medico']) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Data da Consulta</label>
                <input type="date" name="data_consulta" class="form-control form-control-lg" 
                       value="<?= e($old['data_consulta'] ?? '') ?>">
                <?php if (isset($errors['data_consulta'])): ?>
                    <div class="text-danger mt-1"><?= e($errors['data_consulta']) ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Horário</label>
                <input type="time" name="horario" class="form-control form-control-lg" 
                       value="<?= e($old['horario'] ?? '') ?>">
                <?php if (isset($errors['horario'])): ?>
                    <div class="text-danger mt-1"><?= e($errors['horario']) ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Local / Clínica</label>
                <input type="text" name="local" class="form-control form-control-lg" 
                       placeholder="Ex.: Clínica Central, Sala 3" value="<?= e($old['local'] ?? '') ?>">
                <?php if (isset($errors['local'])): ?>
                    <div class="text-danger mt-1"><?= e($errors['local']) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success btn-lg me-2">Salvar Consulta</button>
            <a href="<?= url('consulta/index') ?>" class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>
</div>