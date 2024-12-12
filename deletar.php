<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host   =   "localhost";
    $bd     =   "base_teste2";
    $user   =   "root";
    $pass   =   "";

    try {

        $pdo = new PDO("mysql:host=$host;dbname=$bd", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id         = $_POST["id"];

        $sql = "DELETE FROM usuarios WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        echo "Registro excluído com sucesso!";

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

} else {

    echo "Você não tem permissão para acessar o site!";

}

?>