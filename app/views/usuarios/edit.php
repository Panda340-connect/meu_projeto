<h1><?= e($title) ?></h1>
<a href="<?= e(url('usuario/index')) ?>">Voltar</a>

<form method="post" action="<?= url('usuario/update/' . (int) $usuario['id_usuario']) ?>" data-validate>
    <input type="hidden" name="csrf" value="<?= e($csrf) ?>">

    <label>Nome
        <input type="text" name="nome" value="<?= e($old['nome'] ?? '') ?>">
    </label>
    <?php if (isset($errors['nome'])): ?>
        <p class="erro"><?= e($errors['nome']) ?></p>
    <?php endif; ?>

    <label>E-mail
        <input type="email" name="email" value="<?= e($old['email'] ?? '') ?>">
    </label>
    <?php if (isset($errors['email'])): ?>
        <p class="erro"><?= e($errors['email']) ?></p>
    <?php endif; ?>

    <label>Senha (deixe em branco para manter a atual)
        <input type="password" name="senha">
    </label>
    <?php if (isset($errors['senha'])): ?>
        <p class="erro"><?= e($errors['senha']) ?></p>
    <?php endif; ?>

    <label>Telefone
        <input type="text" name="telefone" placeholder="(00) 00000-0000" value="<?= e($old['telefone'] ?? '') ?>">
    </label>
    <?php if (isset($errors['telefone'])): ?>
        <p class="erro"><?= e($errors['telefone']) ?></p>
    <?php endif; ?>

    <label>Tipo de Usuário
        <select name="tipo_usuario">
            <?php $tipoAtual = $old['tipo_usuario'] ?? 'Idoso'; ?>
            <option value="Idoso" <?= $tipoAtual === 'Idoso' ? 'selected' : '' ?>>Idoso</option>
            <option value="Cuidador" <?= $tipoAtual === 'Cuidador' ? 'selected' : '' ?>>Cuidador</option>
            <option value="Familiar" <?= $tipoAtual === 'Familiar' ? 'selected' : '' ?>>Familiar</option>
            <option value="Administrador" <?= $tipoAtual === 'Administrador' ? 'selected' : '' ?>>Administrador</option>
        </select>
    </label>
    <?php if (isset($errors['tipo_usuario'])): ?>
        <p class="erro"><?= e($errors['tipo_usuario']) ?></p>
    <?php endif; ?>

    <div class="acoes-form">
        <button type="submit">Salvar alterações</button>
        <a class="btn btn-sec" href="<?= url('usuario/index') ?>">Cancelar</a>
    </div>
</form>