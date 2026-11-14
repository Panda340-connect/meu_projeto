<?php

namespace App\Validators;

class ConsultaValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty(trim((string) ($data['id_usuario'] ?? '')))) {
            $errors['id_usuario'] = 'Selecione o usuário da consulta.';
        }
        if (empty(trim($data['especialidade'] ?? ''))) {
            $errors['especialidade'] = 'A especialidade médica é obrigatória.';
        }
        if (empty(trim($data['nome_medico'] ?? ''))) {
            $errors['nome_medico'] = 'Informe o nome do profissional de saúde.';
        }
        if (empty(trim($data['data_consulta'] ?? ''))) {
            $errors['data_consulta'] = 'A data da consulta é obrigatória.';
        }
        if (empty(trim($data['horario'] ?? ''))) {
            $errors['horario'] = 'O horário da consulta é obrigatório.';
        }
        if (empty(trim($data['local'] ?? ''))) {
            $errors['local'] = 'Informe o local de atendimento.';
        }

        return $errors;
    }
}