<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
    public function cadastrarProdutos($nome, $email, $telefone, $alimento, $tipo, $quantidade, $texto) {	

		try
		{
			$query = $this->db->prepare("INSERT INTO Produto(Nome, Email,  Telefone,  Item,  Tipo,  Qtd,  CriadoEm, Mensagem) 
			VALUES(:Nome, :Email, :Telefone, :Item, :Tipo, :Qtd, :CriadoEm, :Mensagem)");
			$query->bindparam(":Nome",     $nome);
			$query->bindparam(":Email",    $email);
			$query->bindparam(":Telefone", $telefone);
			$query->bindparam(":Item",     $alimento);
			$query->bindparam(":Tipo",     $tipo);
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
	public function aprovar_doacao($aprovarId) {

		echo "got here with id: " .$aprovarId;

		$query = $this->db->prepare("UPDATE Produto SET Aprovado = 1 WHERE ProdutoId =:ProdutoId");
		$query->bindparam(":ProdutoId", $aprovarId);
		$query->execute();
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