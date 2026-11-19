<?php
require_once __DIR__ . "/Funcionario.php";

class FuncionarioComum extends Funcionario {
    public function calcularBonus() {
        return $this->getSalario() * 0.05;
    }
}
