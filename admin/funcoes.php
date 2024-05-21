<?php
    //função para mostrar a janela de erro
    function mensagemErro($msg) {
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?=$msg?>',
            }).then((result) => {
                history.back(); 
            })
        </script>
        <?php
        exit;
    } //fim da função