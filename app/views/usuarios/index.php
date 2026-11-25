<h1><?= e($title) ?></h1>
<a href="<?= e(url('usuario/create')) ?>">Novo Usuário</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Tipo de Usuário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= (int) $u['id_usuario'] ?></td>
                <td><?= e($u['nome']) ?></td>
                <td><?= e($u['email']) ?></td>
                <td><?= e($u['telefone'] ?? '') ?></td>
                <td><?= e($u['tipo_usuario'] ?? '') ?></td>
                <td>
                    <a href="<?= e(url('usuario/edit/' . (int) $u['id_usuario'])) ?>">Editar</a>
                    <a href="<?= e(url('usuario/delete/' . (int) $u['id_usuario'])) ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>