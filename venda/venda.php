<!DOCTYPE html>
<?php 
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$title = "Lista de vendas";
$consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
$tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 1 ;

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title   >
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <?php include '../menu.php'; ?>
    <br>
    <a href="cad.php"><button>Novo</button></a>
    <br><br>
    <form method="post">
    <input type="date" name="consulta" id="consulta" value="<?php echo $consulta; ?>">
    <input type="submit" value="Pesquisar">
    <br><br>
        <legend>Método de pesquisa: </legend>
        <input type="radio" name="tipo" value="1" <?php if ($tipo == 1){echo 'checked';}?>> 
        <label for="pagamento">Data de pagamento</label>
        <input type="radio" name="tipo" value="2" <?php if ($tipo == 2){echo 'checked';}?>>
        <label for="vencimento">Data de vencimento</label>
        <input type="radio" name="tipo" value="3" <?php if ($tipo == 3){echo 'checked';}?>>
        <label for="venda">Data da venda</label>
    </form>
    
    <br>
    <table border="1">
       <tr><th>ID</th>
        <th>Data de pagamento</th> 
        <th>Data de vencimento</th> 
        <th>Data da venda</th>
        <th>Alterar</th>
        <th>Excluir</th>
        </tr>
    <?php 
    $pdo = Conexao::getInstance();
    if ($tipo == 1 ) 

    $consulta = $pdo->query("SELECT * FROM venda 
                             WHERE pagamento 
                             LIKE '$consulta%'");

    if ($tipo == 2 )
    $consulta = $pdo->query("SELECT * FROM venda 
                            WHERE vencimento 
                            LIKE '$consulta%'"); 

    if ($tipo == 3 )
    $consulta = $pdo->query("SELECT * FROM venda 
                            WHERE venda 
                            LIKE '$consulta%'");

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        ?>
        <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['pagamento']));?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['vencimento']));?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['venda']));?></td>
            <td><a href='cad.php?acao=editar&id=<?php echo $linha['id'];?>'><img class="icon" src="../img/edit.png" alt=""></a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&id=<?php echo $linha['id'];?>')"><img class="icon" src="../img/delete.png" alt=""></a></td>
        </tr>
    <?php } ?>       
    </table>
    
</body>
</html>
