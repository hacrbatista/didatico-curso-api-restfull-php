<?php

	namespace Source\Controllers;
	
	use Source\Models\Validations;
	
	require "../../vendor/autoload.php";
	require "../Config.php";

	switch($_SERVER["REQUEST_METHOD"])
	{
		case "POST":
			//Pegando o que veio no POST e estamos convertendo isso para um objeto com o json_decode
			//Pois essa informação virá em JSON
			$data = json_decode(\file_get_contents("php://input"),false);	
			
			//Aqui verificamos se não foi passado valor na requisição
			if(!$data)
			{
				header("HTTP/1.1 400 Bad Request");
				echo json_encode(array("response"=>"Nenhum dados informado."));
				exit;
			}
			
			//Criando um array para verificar possíveis erros vindo na requisição.
			$errors = array();
			
			//Nessa sequência de trés IF's abaixo, 
			if(!Validations::validationString($data->first_name))
			{
				array_push($errors, "Nome");
			}
			if(!Validations::validationString($data->last_name))
			{
				array_push($errors, "Sobrenome");
			}
			if(!Validations::validationEmail($data->email))
			{
				array_push($errors, "Email");
			}		
			
			//Se for encontrado algum erro, o array $errors terá um valor maior que 0 (zero)
			if(count($errors) > 0)
			{
				header("HTTP/1.1 400 Bad Request");
				echo json_encode(array("response"=>"Há campos inválidos no formulário!",
				"fields"=>$errors));
				exit;			
			}
			
			//Aqui, fazemos a instanciação da classe User (que está no model no arquivo User.php)
			$user = new User();
			$user->first_name = $data_>first_name; //Dado vindo da requisição
			$user->last_name = $data_>last_name; //Dado vindo da requisição
			$user->email = $data_>email; //Dado vindo da requisição
			
			//Chamando o método save(), que é um método da classe DataLayer (salvará no banco de dados)
			$user->save();
			
			//Se houver algum erro no método save(), ou seja se houver algum erro ao tentar salvar, 
			//então chamamos o método fail() da classe DataLayer
			if($user->fail())
			{
				header("HTTP/1.1 500 Internal Server Error");
				echo json_encode(array("response"=>$user->fail()->getMessage()));
			}
			
		break;
		
		default:
			header("HTTP/1.1 401 Unauthorized");
			echo json_encode(array("response"=>"Método não previsto na API."));
		break;
		
	}
