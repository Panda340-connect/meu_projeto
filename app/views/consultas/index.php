<!-- Cabeçalho de Boas-Vindas igual ao Esboço -->
<div class="mb-4">
    <h1 class="titulo-boasvindas display-6">Olá, Maria! Bem-vinda ao Bem Viver.</h1>
    <p class="text-secondary fs-5 mb-0">Organize sua rotina de forma simples e segura.</p>
</div>

<!-- Grade com os 6 Cards do Esboço -->
<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    <!-- Card 1: Meus Medicamentos -->
    <div class="col">
        <div class="card card-bemviver h-100 text-center p-4">
            <div class="mb-2"><i class="bi bi-capsule icone-card"></i></div>
            <h4 class="fw-bold">Meus Medicamentos</h4>
            <p class="text-muted">Organize seus horários e doses de remédios.</p>
            <div class="mt-auto">
                <a href="<?= url('medicamento/index') ?>" class="btn btn-verde px-4 py-2">Ver Remédios</a>
            </div>
        </div>
    </div>

    <!-- Card 2: Minhas Consultas -->
    <div class="col">
        <div class="card card-bemviver h-100 text-center p-4 border-success">
            <div class="mb-2"><i class="bi bi-heart-pulse icone-card"></i></div>
            <h4 class="fw-bold">Minhas Consultas</h4>
            <p class="text-muted">Organize a rotina de suas consultas médicas.</p>
            <div class="mt-auto">
                <a href="#secao-consultas" class="btn btn-verde px-4 py-2">Ver Consultas</a>
            </div>
        </div>
    </div>

    <!-- Card 3: Meus Exercícios -->
    <div class="col">
        <div class="card card-bemviver h-100 text-center p-4">
            <div class="mb-2"><i class="bi bi-person-walking icone-card"></i></div>
            <h4 class="fw-bold">Meus Exercícios</h4>
            <p class="text-muted">Acompanhe sua rotina de exercícios diários.</p>
            <div class="mt-auto">
                <a href="<?= url('exercicio/index') ?>" class="btn btn-verde px-4 py-2">Ver Exercícios</a>
            </div>
        </div>
    </div>

    <!-- Card 4: Contatos Rápidos -->
    <div class="col">
        <div class="card card-bemviver h-100 text-center p-4">
            <div class="mb-2"><i class="bi bi-telephone-fill icone-card"></i></div>
            <h4 class="fw-bold">Contatos Rápidos</h4>
            <p class="text-muted">Contatos rápidos e cadastro de usuários.</p>
            <div class="mt-auto">
                <a href="<?= url('usuario/index') ?>" class="btn btn-danger fw-semibold px-4 py-2">Ver Contatos</a>
            </div>
        </div>
    </div>

    <!-- Card 5: Minhas Refeições / Direitos -->
    <div class="col">
        <div class="card card-bemviver h-100 text-center p-4">
            <div class="mb-2"><i class="bi bi-file-earmark-text icone-card"></i></div>
            <h4 class="fw-bold">Meus Direitos e Refeições</h4>
            <p class="text-muted">Consultar cardápio diário e direitos do idoso.</p>
            <div class="mt-auto">
                <a href="<?= url('refeicao/index') ?>" class="btn btn-primary fw-semibold px-4 py-2">Consultar</a>
            </div>
        </div>
    </div>

    <!-- Card 6: Lembretes (Agendar Consulta) -->
    <div class="col">
        <div class="card card-bemviver h-100 text-center p-4">
            <div class="mb-2"><i class="bi bi-bell-fill icone-card"></i></div>
            <h4 class="fw-bold">Lembretes</h4>
            <p class="text-muted">Agende novos lembretes de consultas médicas.</p>
            <div class="mt-auto">
                <a href="<?= url('consulta/create') ?>" class="btn btn-primary fw-semibold px-4 py-2">Ver Lembretes</a>
            </div>
        </div>
    </div>
</div>

<!-- Seção da Tabela de Consultas (Sua Parte da Entrega 3) -->
<div id="secao-consultas" class="card card-bemviver p-4 shadow-sm">
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
</div>