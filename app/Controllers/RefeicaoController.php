<?php

namespace App\Controllers;

use App\Models\Refeicao;
use App\Validators\RefeicaoValidator;

require_once __DIR__ . '/../models/Refeicao.php';
require_once __DIR__ . '/../validators/RefeicaoValidator.php';

class RefeicaoController
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
        if (!empty($_POST['id_refeicao'])) {
            return (int) $_POST['id_refeicao'];
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
        $refeicoes = Refeicao::all();
        $this->render('refeicoes/index', [
            'title' => 'Refeições',
            'refeicoes' => $refeicoes,
        ]);
    }

    public function create(): void
    {
        $usuarios = Refeicao::getUsuarios();
        $this->render('refeicoes/form', [
            'title' => 'Cadastrar Refeição',
            'usuarios' => $usuarios,
            'errors' => [],
            'old' => [],
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = RefeicaoValidator::validate($data);

        if (!empty($errors)) {
            $usuarios = Refeicao::getUsuarios();
            $this->render('refeicoes/form', [
                'title' => 'Cadastrar Refeição',
                'usuarios' => $usuarios,
                'errors' => $errors,
                'old' => $data,
            ]);
            return;
        }

        Refeicao::create($data);
        header('Location: ' . url('refeicao/index'));
        exit;
    }

    public function edit(int $id = 0): void
    {
        $id = $this->resolveId($id);
        $refeicao = $id > 0 ? Refeicao::find($id) : null;

        if (!$refeicao) {
            header('Location: ' . url('refeicao/index'));
            exit;
        }

        $usuarios = Refeicao::getUsuarios();
        $this->render('refeicoes/edit', [
            'title' => 'Editar Refeição',
            'refeicao' => $refeicao,
            'usuarios' => $usuarios,
            'errors' => [],
        ]);
    }

    public function update(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id <= 0) {
            header('Location: ' . url('refeicao/index'));
            exit;
        }

        $data = $_POST;
        $errors = RefeicaoValidator::validate($data);

        if (!empty($errors)) {
            $usuarios = Refeicao::getUsuarios();
            $data['id_refeicao'] = $id;
            $this->render('refeicoes/edit', [
                'title' => 'Editar Refeição',
                'refeicao' => $data,
                'usuarios' => $usuarios,
                'errors' => $errors,
            ]);
            return;
        }

        Refeicao::update($id, $data);
        header('Location: ' . url('refeicao/index'));
        exit;
    }

    public function delete(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id > 0) {
            Refeicao::delete($id);
        }
        header('Location: ' . url('refeicao/index'));
        exit;
    }
}