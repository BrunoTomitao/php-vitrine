<?php
    session_start();
    require '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <base href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]; ?>">

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="js/lightbox-plus-jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="vendor/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="vendor/summernote/summernote-bs4.min.js"></script>
    <script src="vendor/summernote/lang/summernote-pt-BR.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    

    <!-- Outros Javascript -->
    <script src="js/parsley.min.js"></script>
    
    <script src="js/jquery.inputmask.min.js"></script>
    <script src="js/bindings/inputmask.binding.js"></script>
    <script src="js/jquery.maskMoney.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">

    <link rel="stylesheet" type="text/css" href="vendor/summernote/summernote.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css"></script>

</head>
<body id="page-top">
    <?php
        require "funcoes.php";

        $campoNaoEstaDefinido = !isset($_SESSION['usuario']);
        if($campoNaoEstaDefinido) {
            require "paginas/login.php";
        } else {
            if(isset($_GET['param'])){
                $page = explode("/", $_GET['param']);
                
                $pasta = $page[0] ?? NULL;
                $arquivo = $page[1] ?? NULL;
                $id = $page[2] ?? NULL;

                $page = "$pasta/$arquivo";

                require "header.php";

                if(file_exists("$page.php")) {
                    require "$page.php";
                } else {
                    require "paginas/erro.php";
                }

                require "footer.php";
            }
        }
    ?>
</body>
</html>