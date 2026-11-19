<?php
require_once __DIR__ . "/Funcionario.php";

class Gerente extends Funcionario {
    public function calcularBonus(): float {
        return $this->getSalario() * 0.15;
    }
}
