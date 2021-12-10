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
        $stmt = $pdo->prepare('INSERT INTO produto (produto_qnt, produto_type, produto_price) VALUES(:produto_qnt, :produto_type, :produto_price)');
        $produto_qnt = $dados['produto_qnt'];
        $stmt->bindParam(':produto_qnt', $produto_qnt, PDO::PARAM_STR);
        $produto_type = $dados['produto_type'];
        $stmt->bindParam(':produto_type', $produto_type, PDO::PARAM_STR); 
        $produto_price = $dados['produto_price'];
        $stmt->bindParam(':produto_price', $produto_price, PDO::PARAM_STR);
        $stmt->execute();
        header("location:cad.php");
        
    }

    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE produto SET produto_qnt = :produto_qnt, produto_type = :produto_type, produto_price = :produto_price WHERE id = :id');
        $produto_qnt = $dados['produto_qnt'];
        $stmt->bindParam(':produto_qnt', $produto_qnt, PDO::PARAM_STR);
        $produto_type = $dados['produto_type'];
        $stmt->bindParam(':produto_type', $produto_type, PDO::PARAM_STR);
        $produto_price = $dados['produto_price'];
        $stmt->bindParam(':produto_price', $produto_price, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $dados['id'];
        $stmt->execute();
        header("location:produto.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from produto WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $id;
        $stmt->execute();
        header("location:produto.php");
        
        //echo "Excluir".$id;

    }
    
    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM produto WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['produto_qnt'] = $linha['produto_qnt'];
            $dados['produto_type'] = $linha['produto_type'];
            $dados['produto_price'] = $linha['produto_price'];
        }
        //var_dump($dados);
        return $dados;
    }
    
    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['produto_qnt'] = $_POST['produto_qnt'];
        $dados['produto_type'] = $_POST['produto_type'];
        $dados['produto_price'] = $_POST['produto_price'];
        return $dados;
    }

?>