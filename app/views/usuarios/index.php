<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 fw-bold text-primary mb-0"><?= e($title) ?></h1>
            <a href="<?= e(url('usuario/create')) ?>" class="btn btn-success fw-semibold">
                + Novo Usuário
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Tipo de Usuário</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usuarios)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Nenhum usuário cadastrado ainda.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= (int) $u['id_usuario'] ?></td>
                                <td class="fw-semibold"><?= e($u['nome']) ?></td>
                                <td><?= e($u['email']) ?></td>
                                <td><?= e($u['telefone'] ?? '') ?></td>
                                <td><?= e($u['tipo_usuario'] ?? '') ?></td>
                                <td class="text-end">
                                    <a href="<?= e(url('usuario/edit/' . (int) $u['id_usuario'])) ?>" class="btn btn-warning btn-sm fw-semibold me-1">
                                        Editar
                                    </a>
                                    <a href="<?= e(url('usuario/delete/' . (int) $u['id_usuario'])) ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Tem certeza que deseja excluir?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>