<?php

namespace App\Controllers;

require_once __DIR__ . '/../models/Exercicio.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../validators/ExercicioValidator.php';

use App\Models\Exercicio;
use App\Models\Usuario;
use App\Validators\ExercicioValidator;

class ExercicioController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        ob_start();
        if (file_exists($viewFile)) {
            require $viewFile;
        }
        $content = ob_get_clean();
        require __DIR__ . '/../views/layouts/main.php';
    }

    private function resolveId(int $id = 0): int
    {
        if ($id > 0) {
            return $id;
        }
        if (!empty($_POST['id_exercicio'])) {
            return (int) $_POST['id_exercicio'];
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
        $exercicios = Exercicio::all();

        $this->render('exercicios/index', [
            'title' => 'Listagem de Exercícios',
            'exercicios' => $exercicios,
        ]);
    }

    public function create(): void
    {
        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? [];
        $errors = $_SESSION['errors'] ?? [];
        $usuarios = Usuario::allByTipo('idoso');

        unset($_SESSION['old'], $_SESSION['errors']);

        $this->render('exercicios/form', [
            'title' => 'Novo Exercício',
            'csrf' => $csrf,
            'old' => $old,
            'errors' => $errors,
            'usuarios' => $usuarios,
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = ExercicioValidator::validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header('Location: ' . url('exercicio/create'));
            exit;
        }

        Exercicio::create($data);
        header('Location: ' . url('exercicio/index'));
        exit;
    }

    public function edit(int $id = 0): void
    {
        $id = $this->resolveId($id);
        $exercicio = $id > 0 ? Exercicio::find($id) : null;

        if (!$exercicio) {
            header('Location: ' . url('exercicio/index'));
            exit;
        }

        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? [];
        $errors = $_SESSION['errors'] ?? [];
        $usuarios = Usuario::allByTipo('idoso');

        unset($_SESSION['old'], $_SESSION['errors']);

        $this->render('exercicios/edit', [
            'title' => 'Editar Exercício',
            'exercicio' => $exercicio,
            'csrf' => $csrf,
            'old' => $old,
            'errors' => $errors,
            'usuarios' => $usuarios,
        ]);
    }

    public function update(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id <= 0) {
            header('Location: ' . url('exercicio/index'));
            exit;
        }

        $data = $_POST;
        $errors = ExercicioValidator::validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header('Location: ' . url('exercicio/edit/' . $id));
            exit;
        }

        Exercicio::update($id, $data);
        header('Location: ' . url('exercicio/index'));
        exit;
    }

    public function delete(int $id = 0): void
    {
        $id = $this->resolveId($id);
        if ($id > 0) {
            Exercicio::delete($id);
        }

        header('Location: ' . url('exercicio/index'));
        exit;
    }
}