SISTEMA DE GERENCIAMENTO DE FUNCIONÁRIOS


COMO EXECUTAR
Acesse http://localhost/phpmyadmin.
Crie ou selecione um banco de dados ao qual seu usuário tenha acesso e importe nele o arquivo banco.sql.
Se o nome do banco não for empresa_db, ajuste $banco em config/conexao.php.
Se necessário, altere também usuário e senha do MySQL em config/conexao.php.
   
 Abra http://localhost/gerenciamento_funcionarios/.

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
