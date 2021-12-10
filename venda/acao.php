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
        $stmt = $pdo->prepare('INSERT INTO venda (pagamento, vencimento, venda) VALUES(:pagamento, :vencimento, :venda)');
        $pagamento = date("Y-m-d",strtotime($dados['pagamento']));
        $stmt->bindParam(':pagamento', $pagamento, PDO::PARAM_STR);
        $vencimento = date("Y-m-d",strtotime($dados['vencimento']));
        $stmt->bindParam(':vencimento', $vencimento, PDO::PARAM_STR); 
        $venda = date("Y-m-d",strtotime($dados['venda']));
        $stmt->bindParam(':venda', $venda, PDO::PARAM_STR);
        $stmt->execute();
        header("location:cad.php");
        
    }

    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE venda SET pagamento = :pagamento, vencimento = :vencimento, venda = :venda WHERE id = :id');
        $pagamento = date("Y-m-d",strtotime($dados['pagamento']));
        $stmt->bindParam(':pagamento', $pagamento, PDO::PARAM_STR);
        $vencimento = date("Y-m-d",strtotime($dados['vencimento']));
        $stmt->bindParam(':vencimento', $vencimento, PDO::PARAM_STR);
        $venda = date("Y-m-d",strtotime($dados['venda']));
        $stmt->bindParam(':venda', $venda, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $dados['id'];
        $stmt->execute();
        header("location:venda.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from venda WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $id;
        $stmt->execute();
        header("location:venda.php");
        
        //echo "Excluir".$id;

    }
    
    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM venda WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['pagamento'] = $linha['pagamento'];
            $dados['vencimento'] = $linha['vencimento'];
            $dados['venda'] = $linha['venda'];
        }
        //var_dump($dados);
        return $dados;
    }
    
    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['pagamento'] = $_POST['pagamento'];
        $dados['vencimento'] = $_POST['vencimento'];
        $dados['venda'] = $_POST['venda'];
        return $dados;
    }

?>