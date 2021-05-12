<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
    public function cadastrarProdutos($nome,$email,$dataNascimento,$cpf,$celular,$cep,$endereco,$numero,
                        $bairro,$cidade,$estado,$qtdPessoas,$empregado,$sobre,$criadoEm)
	{	
		// vamos verificar primeiro se já existe um cadastro com os dados enviados (cpf, email ou celular)
		$query = $this->db->prepare('SELECT * FROM Cadastro WHERE CPF = :CPF OR Email =:Email OR Celular =:Celular ');
		//$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT); // <-- filter your data first (see [Data Filtering](#data_filtering)), especially important for INSERT, UPDATE, etc.
		$query->bindParam(':CPF', $cpf, PDO::PARAM_INT); // <-- Automatically sanitized for SQL by PDO
		$query->bindParam(':Email', $email, PDO::PARAM_INT); // <-- Automatically sanitized for SQL by PDO
		$query->bindParam(':Celular', $celular, PDO::PARAM_INT); // <-- Automatically sanitized for SQL by PDO
		$query->execute();
		$checkUser = $query->fetchAll(PDO::FETCH_ASSOC);

		if (isset($checkUser) && empty($checkUser)) {

			try
			{
				$query = $this->db->prepare("INSERT INTO Cadastro(Nome,Email,DataNascimento,CPF,Celular,CEP,Endereco,Numero,Bairro,Cidade,Estado,QtdPessoas,Empregado,Sobre,CriadoEm) 
				VALUES(:Nome, :Email, :DataNascimento, :CPF,:Celular,:CEP,:Endereco,:Numero,:Bairro,:Cidade,:Estado,:QtdPessoas,:Empregado,:Sobre,:CriadoEm)");
				$query->bindparam(":Nome",$nome);
				$query->bindparam(":Email",$email);
				$query->bindparam(":DataNascimento",$dataNascimento);
				$query->bindparam(":CPF",$cpf);
				$query->bindparam(":Celular",$celular);
				$query->bindparam(":CEP",$cep);
				$query->bindparam(":Endereco",$endereco);
				$query->bindparam(":Numero",$numero);
				$query->bindparam(":Bairro",$bairro);
				$query->bindparam(":Cidade",$cidade);
				$query->bindparam(":Estado",$estado);
				$query->bindparam(":QtdPessoas",$qtdPessoas);
				$query->bindparam(":Empregado",$empregado);
				$query->bindparam(":Sobre",$sobre);
				$query->bindparam(":CriadoEm",$criadoEm);
				$query->execute();
				$result = 'Usuário (' .$email. ') cadastrado com sucesso';
				return $result;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();	
				$result = 'Não foi possível adicionar (' .$email. '), tente novamente';
				return $result;
			}

		} else if (isset($checkUser) && !empty($checkUser)) {

			$result = 'Existe um cadastro com os dados inseridos';
			return $result;

		}
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