<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>CPF</td>
                    <td>Email</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    $sql = "select * from cliente";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                ?>
                    <!-- Aqui é o que o loop vai repetir -->
                    <tr>
                        <td><?=$dados->id?></td>
                        <td><?=$dados->nome?></td>
                        <td><?=$dados->cpf?></td>
                        <td><?=$dados->email?></td>
                        <td>
                            <a 
                                href="cadastros/clientes/<?=$dados->id?>"
                                class="btn btn-success"
                            >
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function excluir(id) {
        console.log(id);
        //Vai confirmar se deseja realmente excluir?
        //location.href='excluir/clientes/id'
    }
</script>

