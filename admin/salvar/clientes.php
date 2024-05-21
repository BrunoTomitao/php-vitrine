<?php

// 1. pegar o valor do nome e guardar em uma variável
$nome = $_POST["nome"] ?? NULL;
$id = $_POST["id"] ?? NULL;
$cpf = $_POST["cpf"] ?? NULL;
$email = $_POST["email"] ?? NULL;

// 2. validar se o nome estiver vazio lançar uma mensagem de erro
if(empty($nome)) {
    mensagemErro("Preencha o campo nome");
}
if(empty($cpf)) {
    mensagemErro("Preencha o campo cpf");
}
if(empty($email)) {
    mensagemErro("Preencha o campo email");
}

// 3. Cria a consulta no banco de dados, verificando se o nome já está cadastrado
$sql = "select id from cliente where email = :email OR cpf = :cpf";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":email", $email);
$consulta->bindParam(":cpf", $cpf);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

// 4. Se tiver cadastro enviar mensagem de erro
if((!empty($dados->id)) && ($id != $dados->id)){
    mensagemErro("Já existe um cliente cadastrada com esse nome");
}

if(empty($id)){
    // 5. Faz o insert para gravar na tabela
    $sql = "insert into cliente (nome,email,cpf) values (:nome,:email,:cpf)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":nome", $nome);
    $consulta->bindParam(":email", $email);
    $consulta->bindParam(":cpf", $cpf);
    $consulta->execute();
} else {
    $sql = "update cliente set nome = :nome, email = :email, cpf = :cpf  where id = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':nome', $nome);
    $consulta->bindParam(':id', $id);
    $consulta->bindParam(":email", $email);
    $consulta->bindParam(":cpf", $cpf);
    $consulta->execute();
}

// 6. Redireciona o usuário para a listagem de clientes
echo "<script>location.href='listar/clientes'</script>";
exit;