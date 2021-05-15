<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
    public function cadastrarProdutos($nome, $email, $telefone, $alimento, $Descricao, $quantidade, $texto) {	

		try
		{
			$query = $this->db->prepare("INSERT INTO Doacao(Nome, Email,  Telefone,  Item,  DescricaoItem,  Qtd,  CriadoEm, Mensagem) 
			VALUES(:Nome, :Email, :Telefone, :Item, :DescricaoItem, :Qtd, :CriadoEm, :Mensagem)");
			$query->bindparam(":Nome",     $nome);
			$query->bindparam(":Email",    $email);
			$query->bindparam(":Telefone", $telefone);
			$query->bindparam(":Item",     $alimento);
			$query->bindparam(":DescricaoItem",$Descricao);
			$query->bindparam(":Qtd",      $quantidade);
			$query->bindparam(":CriadoEm", date("Y-m-d H:i:s"));
			$query->bindparam(":Mensagem", $texto);
			$query->execute();
			//echo "\nPDOStatement::errorInfo():\n";
			//$arr = $query->errorInfo();
			//print_r($arr);
			echo $result = 'Usuário (' .$email. ') cadastrado com sucesso';
			return $result;
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			echo $result = 'Não foi possível adicionar (' .$email. '), tente novamente';
			return $result;
		}
    }

	// Aprovar doação
	public function aprovar_doacao($aprovarId, $qtdAprovar, $itemAprovar) {

		// here we approve doacao
		$query = $this->db->prepare("UPDATE Doacao SET Aprovado = 1 WHERE DoacaoId =:DoacaoId");
		$query->bindparam(":DoacaoId", $aprovarId);
		$query->execute();

		// here we insert into Estoque
		//UPDATE Estoque SET Qtd = (SELECT Qtd FROM Estoque WHERE Item = 	'arroz') + 1 WHERE item = 'arroz'
		$query = $this->db->prepare("UPDATE Estoque SET Qtd = (SELECT Qtd FROM Estoque WHERE Item = '$itemAprovar') + $qtdAprovar WHERE Item =:Item");
		$query->bindparam(":Item", $itemAprovar);
		$query->execute();

		// echo "\nPDOStatement::errorInfo():\n";
		// $arr = $query->errorInfo();
		// print_r($arr);

		echo $result = 'Atualizado aprovação com sucesso';
		return $result;
	}


    public function select($sqlCommando)
	{
		$stmt = $this->db->prepare($sqlCommando);
		$stmt->execute();
		$editRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function verificaLogin($usuario, $password)
	{
		$stmt = $this->db->prepare(" SELECT * FROM Login WHERE UserName = '$usuario' AND Password = '$password' ");
		$stmt->execute();
		$loginArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $loginArray;
	}

	

}
    
?>