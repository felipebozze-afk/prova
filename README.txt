SISTEMA DE GERENCIAMENTO DE FUNCIONÁRIOS

REQUISITOS
- PHP 8 ou superior
- MySQL


COMO EXECUTAR
Acesse http://localhost/phpmyadmin.
Importe o arquivo banco.sql.
Se necessário, altere usuário e senha do MySQL em config/conexao.php.
   
6. Abra http://localhost/gerenciamento_funcionarios/.

FUNCIONALIDADES
- Cadastro e listagem de funcionários.
- Exclusão com confirmação via formulário POST.
- Bônus de 5% para funcionário comum e 15% para gerente.
- Sessão com nome do operador e opção de encerramento.
- Persistência dos dados no MySQL.

ESTRUTURA
models/       Classes POO
views/        Interface HTML e CSS
controllers/  Processamento das operações
config/       Conexão PDO
index.php     Entrada do sistema
banco.sql     Criação do banco e tabela
