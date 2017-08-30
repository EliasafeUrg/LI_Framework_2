<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Notificacao extends CI_Controller{

		function __construc(){

			parent::__construct();	
		}

		public function index(){

			header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

			$notificacaoCode = preg_replace("/[^[:alnum:]-]/", '', $_POST['notificationCode']);

			$data['token'] = "47FF6062291543909AAD9D8615E41BB3";
			$data['email'] = "li_okay@hotmail.com";

			$data = http_build_query($data);

			$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/".$notificacaoCode.'?'.$data;
			// $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/51F508E3EB80EB80399BB43DAFA29CFD8DE4".'?'.$data;
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_URL, $url);
			$xml = curl_exec($curl);
			curl_close($curl);

			$xml = simplexml_load_string($xml);

			$reference = $xml->reference;
			$reference_session = explode("-", $reference);


			$reference = $reference_session[0];
			$id_cliente = $reference_session[1];
	
			if($xml->status == 1 or $xml->status == 2):
				echo "statusAki".$xml->status;
				$this->load->model("Model_Pedido","pedido");
				$this->pedido->pedir($id_cliente,$xml->status, $reference);
			
				foreach ($xml->items as $item) {
					foreach ($item as $produto) {
						
						
						$this->pedido->compra_tem_produto($produto->id,$produto->quantity, $reference);
						// echo $produto->id;
					}
				}
			endif;
			



			



			if($xml->reference && $xml->status):
				$this->load->model("Model_Pedido","pedido");
			
				if($this->pedido->alteraStatusPedido($xml->status,$xml->reference)):
					echo "Atualizado";
				else:
					echo "Falha na atualizacao";
				endif;
			

			endif;

		

		}
	}