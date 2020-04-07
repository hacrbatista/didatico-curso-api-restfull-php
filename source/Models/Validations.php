<?php

	namespace Source\Models;

	final class Validations
	{
		public static function validationString(string $String)
		{
			//Vai validar se a variável recebida possui um certo número de caracteres e se ela não é numérica
			return strlen($String) >= 3 && !is_numeric($String);			
		}
		
		public static function validationEmail(string $Email)
		{
			//Vai validar se a variável recebida é do tipo email
			return filter_var($Email, FILTER_VALIDATE_EMAIL);
		}
		
		public static function validationInteger(string $Integer)
		{
			//Vai validar se a variável recebida é do tipo inteiro
			return filter_var($Integer, FILTER_VALIDATE_INT);
		}
		
	}
