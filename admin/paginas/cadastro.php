<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <script>
        function formatarCEP(cepInput) {
            let cep = cepInput.value.replace(/\D/g, '');
            cep = cep.replace(/(\d{5})(\d)/, '$1-$2');
            cepInput.value = cep;
        }

        async function preencherEndereco() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            if (cep.length !== 8) {
                return;
            }
            const url = `https://viacep.com.br/ws/${cep}/json/`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                if (data.erro) {
                    alert('CEP não encontrado.');
                    return;
                }
                document.getElementById('rua').value = data.logradouro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
            } catch (error) {
                console.error('Erro ao buscar o CEP:', error);
                alert('Erro ao buscar o CEP. Por favor, tente novamente.');
            }
        }
    </script>
</head>
<body>
    <h2>Cadastro</h2>

    <form method="post" action="processar_cadastro.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" required>
        <br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="dataNascimento">Data de Nascimento:</label>
        <input type="date" id="dataNascimento" name="dataNascimento" required>
        <br><br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" oninput="formatarCEP(this); preencherEndereco()" required>
        <br><br>

        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" required>
        <br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required>
        <br><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required>
        <br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
