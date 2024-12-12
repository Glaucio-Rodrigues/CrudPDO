<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host   = "localhost";
    $bd     = "base_teste2";
    $user   = "root";
    $pass   = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$bd", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id         = $_POST["id"];
        $nome       = $_POST["nome"];
        $telefone   = $_POST["telefone"];
        $email      = $_POST["email"];
        $senha      = $_POST["senha"];

        $sql = "UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email, senha = :senha WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo '
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Retorno</title>
            </head>
            <body>
                <h2>Cadastro atualizado com sucesso!</h2>
                <hr>
                <button onclick="history.go(-1);">Retornar</button>
            </body>
            </html>';
        } else {
            echo '
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Retorno</title>
            </head>
            <body>
                <h2>Cadastro não atualizado!</h2>
                <hr>
                <button onclick="history.go(-1);">Retornar</button>
            </body>
            </html>';
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Você não tem permissão para acessar o site!";
}
?>
