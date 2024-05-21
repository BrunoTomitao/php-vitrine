<?php

    $nome = NULL;
    $cpf = NULL;
    $email = NULL;
    
    if (!empty($id)) {
        $sql = "select * from cliente where id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $nome = $dados->nome ?? NULL;
        $cpf = $dados->cpf ?? NULL;
        $email = $dados->email ?? NULL;

    }
?>

<div class="card">
    <div class="card-header">
        <h2>Cadastros de clientes</h2>

        <div class="float-right">
            <a href="listar/clientes" class="btn btn-success">
                Listar clientes
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="salvar/clientes" method="POST">
            <label for="nome">ID</label>
            <input 
                type="text" 
                name="id" 
                id="id" 
                class="form-control"
                readonly
                value="<?=$id?>"
            >
            <label for="nome">Nome do Cliente:</label>
            <input 
                type="text" 
                name="nome" 
                id="nome" 
                class="form-control"
                required
                value="<?=$nome?>"
            >

            <br>
            <label for="nome">Cpf do Cliente:</label>
            <input 
                type="text" 
                name="cpf" 
                id="cpf" 
                class="form-control"
                required
                value="<?=$cpf?>"
            >

            <br>
            <label for="nome">E-mail do Cliente:</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control"
                required
                value="<?=$email?>"
            >

            <br>
        

            <button type="submit" class="btn btn-success">Salvar Dados</button>
        </form>
    </div>
</div>