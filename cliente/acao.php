<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        if ($id == 0)
            inserir($id);
        else
            editar($id);
    }

   
    function inserir($id){
        $dados = dadosForm();
        //var_dump($dados);
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO cliente (nome, email, usuario, senha) VALUES(:nome, :email, :usuario, :senha)');
        $nome = $dados['nome'];
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $email = $dados['email'];
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); 
        $usuario = $dados['usuario'];
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $senha = $dados['senha'];
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        header("location:cad.php");
        
    }

    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE cliente SET nome = :nome, email = :email, usuario = :usuario, senha = :senha WHERE id = :id');
        $nome = $dados['nome'];
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $email = $dados['email'];
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $usuario = $dados['usuario'];
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $senha = $dados['senha'];
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $dados['id'];
        $stmt->execute();
        header("location:cliente.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from cliente WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $id;
        $stmt->execute();
        header("location:cliente.php");
        
        //echo "Excluir".$id;

    }
    
    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM cliente WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['nome'] = $linha['nome'];
            $dados['email'] = $linha['email'];
            $dados['usuario'] = $linha['usuario'];
            $dados['senha'] = $linha['senha'];
        }
        //var_dump($dados);
        return $dados;
    }
    
    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['nome'] = $_POST['nome'];
        $dados['email'] = $_POST['email'];
        $dados['usuario'] = $_POST['usuario'];
        $dados['senha'] = $_POST['senha'];
        return $dados;
    }
?>