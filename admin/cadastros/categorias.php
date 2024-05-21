<?php

    $nome = NULL;
    //categorias/cadastros/1
    if (!empty($id)) {
        $sql = "select * from categoria where id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $nome = $dados->nome ?? NULL;

    }
?>

<div class="card">
    <div class="card-header">
        <h2>Cadastros de Categorias</h2>

        <div class="float-right">
            <a href="listar/categorias" class="btn btn-success">
                Listar Categorias
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="salvar/categorias" method="POST">
            <label for="id">ID da Categoria</label>
            <input 
                type="text"
                name="id"
                id="id"
                class="form-control"
                value="<?=$id?>"
                readonly
            >

            <label for="nome">Nome da Categoria:</label>
            <input 
                type="text" 
                name="nome" 
                id="nome" 
                class="form-control"
                required
                value="<?=$nome?>"
            >

            <br>

            <button type="submit" class="btn btn-success">Salvar Dados</button>
        </form>
    </div>
</div>