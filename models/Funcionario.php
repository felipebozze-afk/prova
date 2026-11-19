<?php
abstract class Funcionario {
    protected string $nome;
    protected string $email;
    protected float $salario;

    public function __construct(string $nome, string $email, float $salario) {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSalario($salario);
    }

    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getSalario(): float { return $this->salario; }

    public function setNome(string $nome): void { $this->nome = trim($nome); }
    public function setEmail(string $email): void { $this->email = trim($email); }
    public function setSalario(float $salario): void { $this->salario = $salario; }

    abstract public function calcularBonus(): float;
}
