<?php

namespace App\Controllers;

use App\Models\Medicamento;
use App\Models\Usuario;
use App\Validators\MedicamentoValidator;

require_once __DIR__ . '/../models/Medicamento.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../validators/MedicamentoValidator.php';

class MedicamentoController
{
    private function render(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        require __DIR__ . '/../views/layouts/main.php';
    }

    private function resolveId(int $id = 0): int
    {
        if ($id > 0) {
            return $id;
        }
        if (!empty($_POST['id_medicamento'])) {
            return (int) $_POST['id_medicamento'];
        }
        if (!empty($_POST['id'])) {
            return (int) $_POST['id'];
        }
        if (!empty($_GET['id'])) {
            return (int) $_GET['id'];
        }
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '';
        if (preg_match('#/(\d+)/?$#', $uri, $matches)) {
            return (int) $matches[1];
        }
        return 0;
    }

    public function index(): void
    {
        $medicamentos = Medicamento::all();
        $this->render('medicamentos/index', [
            'title' => 'Medicamentos',
            'medicamentos' => $medicamentos,
        ]);
    }

    public function create(): void
    {
        $usuarios = Usuario::allByTipo('idoso');
        $this->render('medicamentos/form', [
            'title' => 'Cadastrar Medicamento',
            'usuarios' => $usuarios,
            'errors' => [],
            'old' => [],
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = MedicamentoValidator::validate($data);

        if (!empty($errors)) {
            $usuarios = Usuario::allByTipo('idoso');
            $this->render('medicamentos/form', [
                'title' => 'Cadastrar Medicamento',
                'usuarios' => $usuarios,
                'errors' => $errors,
                'old' => $data,
            ]);
            return;
        }

        Medicamento::create($data);
        header('Location: ' . url('medicamento/index'));
        exit;
    }

    public function edit(int $id = 0): void
    {
        $id = $this->resolveId($id);
        $medicamento = $id > 0 ? Medicamento::find($id) : null;

        if (!$medicamento) {
            header('Location: ' . url('medicamento/index'));
            exit;
        }

        $usuarios = Usuario::allByTipo('idoso');
        $this->render('medicamentos/edit', [
            'title' => 'Editar Medicamento',
            'medicamento' => $medicamento,
            'usuarios' => $usuarios,
            'errors' => [],
        ]);
    }

    public function update(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id <= 0) {
            header('Location: ' . url('medicamento/index'));
            exit;
        }

        $data = $_POST;
        $errors = MedicamentoValidator::validate($data);

        if (!empty($errors)) {
            $usuarios = Usuario::allByTipo('idoso');
            $data['id_medicamento'] = $id;
            $this->render('medicamentos/edit', [
                'title' => 'Editar Medicamento',
                'medicamento' => $data,
                'usuarios' => $usuarios,
                'errors' => $errors,
            ]);
            return;
        }

        Medicamento::update($id, $data);
        header('Location: ' . url('medicamento/index'));
        exit;
    }

    public function delete(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id > 0) {
            Medicamento::delete($id);
        }
        header('Location: ' . url('medicamento/index'));
        exit;
    }
}