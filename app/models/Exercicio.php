<?php

class Exercicio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarTodos(): array
    {
        $sql = "SELECT id, nome, id_usuario, descricao, frequencia, duracao, data_exercicio, horario
                FROM exercicio
                ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar(array $dados): bool
    {
        $sql = "INSERT INTO exercicio (
                    nome,
                    id_usuario,
                    descricao,
                    frequencia,
                    duracao,
                    data_exercicio,
                    horario
                ) VALUES (
                    :nome,
                    :id_usuario,
                    :descricao,
                    :frequencia,
                    :duracao,
                    :data_exercicio,
                    :horario
                )";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nome'           => $dados['nome'],
            ':id_usuario'     => $dados['id_usuario'],
            ':descricao'      => $dados['descricao'],
            ':frequencia'     => $dados['frequencia'],
            ':duracao'        => $dados['duracao'],
            ':data_exercicio' => $dados['data_exercicio'],
            ':horario'        => $dados['horario'],
        ]);
    }
}
