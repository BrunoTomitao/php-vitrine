<?php
session_start();

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos foram preenchidos
    if (isset($_POST['nome'], $_POST['cpf'], $_POST['email'], $_POST['dataNascimento'], $_POST['cep'], $_POST['rua'], $_POST['cidade'], $_POST['estado'])) {
        // Captura os dados do formulário
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $dataNascimento = $_POST['dataNascimento'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        // Validação básica do CPF, e-mail e CEP
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['mensagem'] = "Formato de e-mail inválido. Por favor, insira um e-mail válido.";
        } elseif (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
            $_SESSION['mensagem'] = "Formato de CPF inválido. Por favor, insira um CPF válido no formato '123.456.789-00'.";
        } elseif (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
            $_SESSION['mensagem'] = "Formato de CEP inválido. Por favor, insira um CEP válido no formato '12345-678'.";
        } else {
            try {
                // Conexão com o banco de dados
                $pdo = new PDO("mysql:host=localhost;dbname=vitrine", "root", "");

                // Prepara a consulta SQL para inserção de dados
                $sql = "INSERT INTO cadastro (nome, cpf, email, data_nascimento, cep, rua, cidade, estado) VALUES (:nome, :cpf, :email, :dataNascimento, :cep, :rua, :cidade, :estado)";
                $consulta = $pdo->prepare($sql);

                // Executa a consulta, vinculando os parâmetros
                $consulta->execute([
                    ':nome' => $nome,
                    ':cpf' => $cpf,
                    ':email' => $email,
                    ':dataNascimento' => $dataNascimento,
                    ':cep' => $cep,
                    ':rua' => $rua,
                    ':cidade' => $cidade,
                    ':estado' => $estado
                ]);

                // Define mensagem de sucesso
                $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
            } catch (PDOException $e) {
                // Em caso de erro, define mensagem de erro
                $_SESSION['mensagem'] = "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    } else {
        $_SESSION['mensagem'] = "Por favor, preencha todos os campos.";
    }
} else {
    // Se o método de requisição não for POST, redireciona para a página de cadastro
    header("Location: cadastro.php");
    exit();
}

// Redireciona de volta para a página de cadastro
header("Location: cadastro.php");
exit();
?>
