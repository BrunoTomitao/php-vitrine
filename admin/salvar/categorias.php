<?php

// 1. pegar o valor do nome e guardar em uma variável
$nome = $_POST["nome"] ?? NULL;
$id = $_POST["id"] ?? NULL;

// 2. validar se o nome estiver vazio lançar uma mensagem de erro
if(empty($nome)) {
    mensagemErro("Preencha o campo nome");
}

// 3. Cria a consulta no banco de dados, verificando se o nome já está cadastrado
$sql = "select id from categoria where nome = :nome";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":nome", $nome);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

// 4. Se tiver cadastro enviar mensagem de erro
if(!empty($dados->id)){
    mensagemErro("Já existe uma categoria cadastrada com esse nome");
}

if(empty($id)){
    // 5. Faz o insert para gravar na tabela
    $sql = "insert into categoria (nome) values (:nome)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":nome", $nome);
    $consulta->execute();
} else {
    $sql = "update categoria set nome = :nome where id = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':nome', $nome);
    $consulta->bindParam(':id', $id);
    $consulta->execute();
}

// 6. Redireciona o usuário para a listagem de categorias
echo "<script>location.href='listar/categorias'</script>";
exit;