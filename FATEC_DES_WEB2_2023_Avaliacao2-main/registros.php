<?php
session_start();
require_once('header.php');
require_once('dados_banco.php');

try {
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM veiculos";

    $stmt = $conn->query($sql);
} catch (PDOException $err) {
    // Em caso de erro na conexão ou consulta
    echo "Erro na consulta: " . $err->getMessage();
    // Você também pode registrar esse erro em um arquivo de log.
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
