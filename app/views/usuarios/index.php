<h1><?= e($title) ?></h1>
<a href="<?= e(url('usuario/create')) ?>">Novo Usuário</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>E-mail</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= (int) $u['id'] ?></td>
                <td><?= e($u['name']) ?></td>
                <td><?= e($u['last_name']) ?></td>
                <td><?= e($u['email']) ?></td>
                <td><?= e(format_cpf($u['cpf'])) ?></td>
                <td><?= e($u['birth_date']) ?></td>
                <td>
                    <a href="<?= e(url('usuario/edit/' . (int) $u['id'])) ?>">Editar</a>
                    <a href="<?= e(url('usuario/delete/' . (int) $u['id'])) ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>