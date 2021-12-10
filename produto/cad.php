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
<a href="produto.php"><button>Listar</button></a>
<br><br>
<form action="acao.php" method="post">
<fieldset>
<label for="id">Id:  </label>
<input readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>

<label for="produto_qnt">Quantidade de Produtos:  </label>
<input required=true   type="text" name="produto_qnt" id="produto_qnt" value="<?php if ($acao == "editar") echo $dados['produto_qnt']; ?>"><br>

<label for="produto_type">Tipos de produto:  </label>
<input required=true   type="text" name="produto_type" id="produto_type" value="<?php if ($acao == "editar") echo $dados['produto_type']; ?>"><br>

<label for="produto_price">Preço dos produtos: </label>
<input required=true   type="text" name="produto_price" id="produto_price" value="<?php if ($acao == "editar") echo $dados['produto_price']; ?>"><br>

    <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
</fieldset>
</form>
</body>
</html>