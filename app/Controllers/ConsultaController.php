<?php

namespace App\Controllers;

use App\Models\Consulta;
use App\Models\Usuario;
use App\Validators\ConsultaValidator;

require_once __DIR__ . '/../models/Consulta.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../validators/ConsultaValidator.php';

class ConsultaController
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
        if (!empty($_POST['id_consulta'])) {
            return (int) $_POST['id_consulta'];
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
        $consultas = Consulta::all();
        $this->render('consultas/index', [
            'title'     => 'Consultas Médicas',
            'consultas' => $consultas
        ]);
    }

    public function create(): void
    {
        $usuarios = Usuario::allByTipo('idoso');
        $this->render('consultas/form', [
            'title'    => 'Agendar Consulta',
            'usuarios' => $usuarios,
            'errors'   => [],
            'old'      => []
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = ConsultaValidator::validate($data);

        if (!empty($errors)) {
            $usuarios = Usuario::allByTipo('idoso');
            $this->render('consultas/form', [
                'title'    => 'Agendar Consulta',
                'usuarios' => $usuarios,
                'errors'   => $errors,
                'old'      => $data
            ]);
            return;
        }

        Consulta::create($data);
        header('Location: ' . url('consulta/index'));
        exit;
    }

    public function edit(int $id = 0): void
    {
        $id = $this->resolveId($id);
        $consulta = $id > 0 ? Consulta::find($id) : null;

        if (!$consulta) {
            header('Location: ' . url('consulta/index'));
            exit;
        }

        $usuarios = Usuario::allByTipo('idoso');
        $this->render('consultas/edit', [
            'title'    => 'Editar Consulta',
            'consulta' => $consulta,
            'usuarios' => $usuarios,
            'errors'   => []
        ]);
    }

    public function update(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id <= 0) {
            header('Location: ' . url('consulta/index'));
            exit;
        }

        $data = $_POST;
        $errors = ConsultaValidator::validate($data);

        if (!empty($errors)) {
            $usuarios = Usuario::allByTipo('idoso');
            $data['id_consulta'] = $id;
            $this->render('consultas/edit', [
                'title'    => 'Editar Consulta',
                'consulta' => $data,
                'usuarios' => $usuarios,
                'errors'   => $errors
            ]);
            return;
        }

        Consulta::update($id, $data);
        header('Location: ' . url('consulta/index'));
        exit;
    }

    public function delete(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id > 0) {
            Consulta::delete($id);
        }
        header('Location: ' . url('consulta/index'));
        exit;
    }
}