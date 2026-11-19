<?php
class FuncionarioController {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar(array $dados): array {
        $nome = trim($dados["nome"] ?? "");
        $email = trim($dados["email"] ?? "");
        $salario = filter_var($dados["salario"] ?? null, FILTER_VALIDATE_FLOAT);
        $tipo = $dados["tipo"] ?? "";

        if ($nome === "" || $email === "" || $salario === false || $salario <= 0 ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !in_array($tipo, ["Comum", "Gerente"], true)) {
            return ["mensagem" => "Preencha todos os campos corretamente."];
        }

        $classe = $tipo === "Gerente" ? "Gerente" : "FuncionarioComum";
        $funcionario = new $classe($nome, $email, (float)$salario);

        $sql = "INSERT INTO funcionarios (nome, email, salario, tipo) VALUES (:nome, :email, :salario, :tipo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $funcionario->getNome(),
            ":email" => $funcionario->getEmail(),
            ":salario" => $funcionario->getSalario(),
            ":tipo" => $tipo
        ]);

        return ["mensagem" => "Funcionário cadastrado com sucesso!"];
    }

    public function listar(): array {
        return $this->pdo->query("SELECT * FROM funcionarios ORDER BY id DESC")->fetchAll();
    }

    public function buscar(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM funcionarios WHERE id = ?");
        $stmt->execute([$id]);
        $registro = $stmt->fetch();
        return $registro ?: null;
    }

    public function excluir(int $id): array {
        if ($id <= 0 || !$this->buscar($id)) {
            return ["mensagem" => "Funcionário não encontrado."];
        }
        $stmt = $this->pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
        $stmt->execute([$id]);
        return ["mensagem" => "Funcionário excluído com sucesso!"];
    }
}
