<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
//var_dump($dados);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
</head>
<body>
<br>
<a href="venda.php"><button>Listar</button></a>
<br><br>
<form action="acao.php" method="post">
<fieldset>
<label for="id">Id:  </label>
<input readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>

<label for="pagamento">Data de pagamento: </label>
<input required=true   type="date" name="pagamento" id="pagamento" value="<?php if ($acao == "editar") echo $dados['pagamento']; ?>"><br>

<label for="vencimento">Data de vencimento: </label>
<input required=true   type="date" name="vencimento" id="vencimento" value="<?php if ($acao == "editar") echo $dados['vencimento']; ?>"><br>

<label for="venda">Data da venda :</label>
<input required=true   type="date" name="venda" id="venda" value="<?php if ($acao == "editar") echo $dados['venda']; ?>"><br>

    <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
</fieldset>
</form>
</body>
</html>