<!DOCTYPE html>
<?php 
     include_once "conf/default.inc.php";
     require_once "conf/Conexao.php";
     $title = "Lista de Clientes";
     $id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
</head>
<body>
<a href="index.php"><button>Listar</button></a>
<a href="cad.php"><button>Novo</button></a>
<a href="cad.php?acao=editar&codigo=<?php echo $id;?>"><button>Alterar</button></a>
</br></br>
<?php
   
    $sql = "SELECT * FROM marca WHERE codigo = $id";
   
    $pdo = Conexao::getInstance(); 
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
        echo "Código: {$linha['codigo']} - Descrição: {$linha['descricao']}<br />";
    }
?>
</body>
</html>