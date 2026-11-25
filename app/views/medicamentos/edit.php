<?php
$errors = $errors ?? [];
$medicamento = $medicamento ?? [];
$usuarios = $usuarios ?? [];
$idMedicamento = $medicamento['id_medicamento'] ?? '';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= e($title ?? 'Editar Medicamento') ?></h1>
    <a href="<?= e(url('medicamento/index')) ?>" class="btn btn-secondary">Voltar</a>
</div>

<form action="<?= e(url('medicamento/update/' . $idMedicamento)) ?>" method="POST" class="card card-body">
    <input type="hidden" name="id_medicamento" value="<?= e($idMedicamento) ?>">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nome_medicamento" class="form-label">Nome do Medicamento</label>
            <input type="text" name="nome_medicamento" id="nome_medicamento" maxlength="100"
                   class="form-control <?= isset($errors['nome_medicamento']) ? 'is-invalid' : '' ?>"
                   value="<?= e($medicamento['nome_medicamento'] ?? '') ?>" required>
            <?php if (isset($errors['nome_medicamento'])): ?>
                <div class="invalid-feedback"><?= e($errors['nome_medicamento']) ?></div>
            <?php endif; ?>
        </div>

        <div class="col-md-6 mb-3">
            <label for="dosagem" class="form-label">Dosagem</label>
            <input type="text" name="dosagem" id="dosagem" maxlength="50"
                   class="form-control <?= isset($errors['dosagem']) ? 'is-invalid' : '' ?>"
                   value="<?= e($medicamento['dosagem'] ?? '') ?>" required>
            <?php if (isset($errors['dosagem'])): ?>
                <div class="invalid-feedback"><?= e($errors['dosagem']) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="horario" class="form-label">Horário</label>
            <input type="time" name="horario" id="horario"
                   class="form-control <?= isset($errors['horario']) ? 'is-invalid' : '' ?>"
                   value="<?= e($medicamento['horario'] ?? '') ?>" required>
            <?php if (isset($errors['horario'])): ?>
                <div class="invalid-feedback"><?= e($errors['horario']) ?></div>
            <?php endif; ?>
        </div>

        <div class="col-md-4 mb-3">
            <label for="frequencia" class="form-label">Frequência</label>
            <input type="text" name="frequencia" id="frequencia" maxlength="50"
                   class="form-control <?= isset($errors['frequencia']) ? 'is-invalid' : '' ?>"
                   value="<?= e($medicamento['frequencia'] ?? '') ?>" required>
            <?php if (isset($errors['frequencia'])): ?>
                <div class="invalid-feedback"><?= e($errors['frequencia']) ?></div>
            <?php endif; ?>
        </div>

        <div class="col-md-4 mb-3">
            <label for="id_usuario" class="form-label">Usuário (Idoso)</label>
            <select name="id_usuario" id="id_usuario"
                    class="form-select <?= isset($errors['id_usuario']) ? 'is-invalid' : '' ?>" required>
                <option value="">Selecione...</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= e($usuario['id_usuario']) ?>"
                        <?= ((string) ($medicamento['id_usuario'] ?? '') === (string) $usuario['id_usuario']) ? 'selected' : '' ?>>
                        <?= e($usuario['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['id_usuario'])): ?>
                <div class="invalid-feedback"><?= e($errors['id_usuario']) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="<?= e(url('medicamento/index')) ?>" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>