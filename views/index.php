<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <link rel="stylesheet" href="views/style.css">
</head>
<body>
    <main class="container">
        <header class="cabecalho">
            <div>
                <h1>Funcionários da empresa</h1>
                <p>Cadastre e consulte os funcionários.</p>
            </div>
            <section class="sessao">
                <?php if (isset($_SESSION["operador"])): ?>
                    <p>Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION["operador"], ENT_QUOTES, "UTF-8") ?></strong>!</p>
                    <form method="POST">
                        <button class="botao secundario" type="submit" name="acao" value="encerrar_sessao">Encerrar sessão</button>
                    </form>
                <?php else: ?>
                    <form method="POST">
                        <label for="operador">Nome do operador</label>
                        <div class="linha">
                            <input id="operador" name="operador" type="text" required>
                            <button class="botao" type="submit" name="acao" value="iniciar_sessao">Iniciar sessão</button>
                        </div>
                    </form>
                <?php endif; ?>
            </section>
        </header>

        <?php if (!empty($mensagem)): ?>
            <p class="mensagem" role="status"><?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?></p>
        <?php endif; ?>

        <?php if ($funcionarioExcluir): ?>
            <section class="cartao confirmacao">
                <h2>Confirmar exclusão</h2>
                <p>Deseja excluir <?= htmlspecialchars($funcionarioExcluir["nome"], ENT_QUOTES, "UTF-8") ?>?</p>
                <form method="POST" class="linha">
                    <input type="hidden" name="id" value="<?= (int)$funcionarioExcluir["id"] ?>">
                    <button class="botao perigo" type="submit" name="acao" value="excluir">Sim, excluir</button>
                    <a class="botao secundario" href="index.php">Cancelar</a>
                </form>
            </section>
        <?php endif; ?>

        <section class="cartao">
            <h2>Cadastrar funcionário</h2>
            <form method="POST" class="formulario">
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" maxlength="100" required>

                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" maxlength="150" required>

                <label for="salario">Salário</label>
                <input id="salario" name="salario" type="number" min="0" step="0.01" required>

                <label for="tipo">Tipo de funcionário</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione</option>
                    <option value="FuncionarioComum">Funcionário comum</option>
                    <option value="Gerente">Gerente</option>
                </select>

                <button class="botao" type="submit" name="acao" value="cadastrar">Cadastrar</button>
            </form>
        </section>

        <section class="cartao">
            <h2>Funcionários cadastrados</h2>
            <?php if (count($funcionarios) === 0): ?>
                <p>Nenhum funcionário cadastrado.</p>
            <?php else: ?>
                <div class="tabela">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Tipo</th>
                                <th>Salário</th>
                                <th>Bônus</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($funcionarios as $funcionario): ?>
                                <tr>
                                    <td><?= htmlspecialchars($funcionario["nome"], ENT_QUOTES, "UTF-8") ?></td>
                                    <td><?= htmlspecialchars($funcionario["email"], ENT_QUOTES, "UTF-8") ?></td>
                                    <td><?= htmlspecialchars($funcionario["tipo_nome"], ENT_QUOTES, "UTF-8") ?></td>
                                    <td>R$ <?= number_format((float)$funcionario["salario"], 2, ",", ".") ?></td>
                                    <td>R$ <?= number_format((float)$funcionario["bonus"], 2, ",", ".") ?></td>
                                    <td><a class="botao perigo" href="index.php?excluir=<?= (int)$funcionario["id"] ?>">Excluir</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
