<?php
$errors = $errors ?? [];
$refeicao = $refeicao ?? [];
$usuarios = $usuarios ?? [];
$idRefeicao = $refeicao['id_refeicao'] ?? '';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= e($title ?? 'Editar Refeição') ?></h1>
    <a href="<?= e(url('refeicao/index')) ?>" class="btn btn-secondary">Voltar</a>
</div>

<form action="<?= e(url('refeicao/update/' . $idRefeicao)) ?>" method="POST" class="card card-body">
    <input type="hidden" name="id_refeicao" value="<?= e($idRefeicao) ?>">

    <div class="mb-3">
        <label for="nome_refeicao" class="form-label">Nome da Refeição</label>
        <input type="text" name="nome_refeicao" id="nome_refeicao" maxlength="50"
               class="form-control <?= isset($errors['nome_refeicao']) ? 'is-invalid' : '' ?>"
               value="<?= e($refeicao['nome_refeicao'] ?? '') ?>" required>
        <?php if (isset($errors['nome_refeicao'])): ?>
            <div class="invalid-feedback"><?= e($errors['nome_refeicao']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" rows="3" maxlength="255"
                  class="form-control <?= isset($errors['descricao']) ? 'is-invalid' : '' ?>"
                  required><?= e($refeicao['descricao'] ?? '') ?></textarea>
        <?php if (isset($errors['descricao'])): ?>
            <div class="invalid-feedback"><?= e($errors['descricao']) ?></div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="horario" class="form-label">Horário</label>
            <input type="time" name="horario" id="horario"
                   class="form-control <?= isset($errors['horario']) ? 'is-invalid' : '' ?>"
                   value="<?= e($refeicao['horario'] ?? '') ?>" required>
            <?php if (isset($errors['horario'])): ?>
                <div class="invalid-feedback"><?= e($errors['horario']) ?></div>
            <?php endif; ?>
        </div>

        <div class="col-md-6 mb-3">
            <label for="id_usuario" class="form-label">Usuário (Idoso)</label>
            <select name="id_usuario" id="id_usuario"
                    class="form-select <?= isset($errors['id_usuario']) ? 'is-invalid' : '' ?>" required>
                <option value="">Selecione...</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= e($usuario['id_usuario']) ?>"
                        <?= ((string) ($refeicao['id_usuario'] ?? '') === (string) $usuario['id_usuario']) ? 'selected' : '' ?>>
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
        <a href="<?= e(url('refeicao/index')) ?>" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>