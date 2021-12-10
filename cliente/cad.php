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
<a href="cliente.php"><button>Listar</button></a>
<br><br>
<form action="acao.php" method="post">
<fieldset>
<label for="id">Id:  </label>
<input readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>

<label for="nome">Nome:  </label>
<input required=true   type="text" name="nome" id="nome" value="<?php if ($acao == "editar") echo $dados['nome']; ?>"><br>

<label for="email">Email:  </label>
<input required=true   type="text" name="email" id="email" value="<?php if ($acao == "editar") echo $dados['email']; ?>"><br>

<label for="usuario">Usuario: </label>
<input required=true   type="text" name="usuario" id="usuario" value="<?php if ($acao == "editar") echo $dados['usuario']; ?>"><br>

<label for="senha">Senha:</label>
<input required=true   type="text" name="senha" id="senha" value="<?php if ($acao == "editar") echo $dados['senha']; ?>"><br>
    <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
</fieldset>
</form>
</body>
</html>