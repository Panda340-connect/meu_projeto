<?php
$selectedUsuario = (string) ($old['id_usuario'] ?? '');
?>

<h1 class="mb-4"><?= e($title ?? 'Novo Exercício') ?></h1>

<form action="<?= url('exercicio/store') ?>" method="POST" class="row g-3">
    <?php if (!empty($csrf)): ?>
        <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
    <?php endif; ?>

    <div class="col-md-6">
        <label for="nome" class="form-label">Nome do exercício</label>
        <input type="text" id="nome" name="nome" class="form-control" value="<?= e($old['nome'] ?? '') ?>" required>
        <?php if (!empty($errors['nome'])): ?>
            <div class="text-danger small mt-1"><?= e($errors['nome']) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="id_usuario" class="form-label">Idoso</label>
        <select id="id_usuario" name="id_usuario" class="form-select" required>
            <option value="">Selecione um idoso</option>
            <?php foreach (($usuarios ?? []) as $u): ?>
                <option value="<?= e((string) $u['id_usuario']) ?>" <?= $selectedUsuario === (string) $u['id_usuario'] ? 'selected' : '' ?>>
                    <?= e($u['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (empty($usuarios)): ?>
            <div class="form-text text-warning">Nenhum usuário do tipo Idoso cadastrado ainda.</div>
        <?php endif; ?>
        <?php if (!empty($errors['id_usuario'])): ?>
            <div class="text-danger small mt-1"><?= e($errors['id_usuario']) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea id="descricao" name="descricao" rows="3" class="form-control" required><?= e($old['descricao'] ?? '') ?></textarea>
        <?php if (!empty($errors['descricao'])): ?>
            <div class="text-danger small mt-1"><?= e($errors['descricao']) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="frequencia" class="form-label">Frequência</label>
        <input type="text" id="frequencia" name="frequencia" placeholder="Ex: 3x na semana" class="form-control" value="<?= e($old['frequencia'] ?? '') ?>" required>
        <?php if (!empty($errors['frequencia'])): ?>
            <div class="text-danger small mt-1"><?= e($errors['frequencia']) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="duracao" class="form-label">Duração</label>
        <input type="text" id="duracao" name="duracao" placeholder="Ex: 45 min" class="form-control" value="<?= e($old['duracao'] ?? '') ?>" required>
        <?php if (!empty($errors['duracao'])): ?>
            <div class="text-danger small mt-1"><?= e($errors['duracao']) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="data_exercicio" class="form-label">Data do exercício</label>
        <input type="date" id="data_exercicio" name="data_exercicio" class="form-control" value="<?= e($old['data_exercicio'] ?? '') ?>" required>
        <?php if (!empty($errors['data_exercicio'])): ?>
            <div class="text-danger small mt-1"><?= e($errors['data_exercicio']) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="horario" class="form-label">Horário</label>
        <input type="time" id="horario" name="horario" class="form-control" value="<?= e($old['horario'] ?? '') ?>" required>
        <?php if (!empty($errors['horario'])): ?>
            <div class="text-danger small mt-1"><?= e($errors['horario']) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= url('exercicio/index') ?>" class="btn btn-secondary">Voltar</a>
    </div>
</form>