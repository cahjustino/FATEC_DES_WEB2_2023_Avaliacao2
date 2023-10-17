<?php
session_start();
require_once('header.php');
require_once('dados_banco.php');

try {
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Defina sua consulta SQL aqui
    $sql = "INSERT INTO sua_tabela (campo1, campo2) VALUES (:valor1, :valor2)";

    // Substitua 'sua_tabela', 'campo1', 'campo2', :valor1' e ':valor2' pelos valores corretos.

    // Execute a consulta
    $stmt = $conn->prepare($sql);
    
    // Substitua os valores nos parâmetros da consulta pelos valores reais
    $stmt->bindParam(':valor1', $valor1);
    $stmt->bindParam(':valor2', $valor2);
    
    $valor1 = "Valor do campo 1"; // Substitua pelo valor real
    $valor2 = "Valor do campo 2"; // Substitua pelo valor real
    
    // Execute a consulta
    $stmt->execute();

    // Continue com o processamento após a inserção no banco de dados

} catch (PDOException $err) {
    // Em caso de erro na conexão ou consulta
    echo "Erro na consulta: " . $err->getMessage();
}
?>

 
 <!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Portaria Fatec</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h2>
            <?php echo $_SESSION["username"]; ?>
            <br>
        </h2>
    </div>
    <p>

    <form action="registros_encontrados.php" method="GET">
        <div class="form-group">
            <label>Selecione a placa</label>
            <br>
            <select name="placa_id">
                <?php
                    while ($row = $stmt->fetch()) {
                        print "<option value=". $row['id'].">". $row['placa']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Acessar">
        </div>
    </form>

    <a href="principal.php" class="btn btn-primary">Voltar</a>
    <br><br>

    </p>
</body>
</html>
