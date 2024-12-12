<?php 
$nome = $telefone = $email = $senha = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host   = "localhost";
    $bd     = "base_teste2";
    $user   = "root";
    $pass   = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$bd", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id  = $_POST["id"];

        $sql = "SELECT * FROM Usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $nome = $row['nome'];
            $telefone = $row['telefone'];
            $email = $row['email'];
            $senha = $row['senha'];
        } else {
            $nome = $telefone = $email = $senha = "";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesquisa e Atualização Cadastral</title>
</head>
<body>
    <h2>Atualização de Cadastro</h2>
    <!-- Formulário de pesquisa de usuário -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <p>
            ID: <input type="text" name="id">
            <input type="submit" value="Pesquisar">
        </p>
    </form>


    <hr>



    <!-- Atualização dos dados -->
    <?php if (!empty($nome)) { ?>
        <form method="post" action="atualiza.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <p>Nome:<br>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
            </p>

            <p>Telefone:<br>
                <input type="number" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>">
            </p>

            <p>Email:<br>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </p>

            <p>Senha:<br>
                <input type="password" name="senha" value="<?php echo htmlspecialchars($senha); ?>">
            </p>

            <p>
                <input type="submit" value="Atualizar Cadastro">
            </p>
        </form>
    <?php } ?>
</body>
</html>
