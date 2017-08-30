<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	class Pagamento extends CI_Controller{
		public function index(){
			$pedido = preg_replace('/[^[:alnum:]-]/','', $_POST['idPedido']);
			$data['email'] = "li_okay@hotmail.com";
			$data['token'] = "47FF6062291543909AAD9D8615E41BB3";
			$data['currency'] ="BRL";
			$data['reference'] = $pedido;
			
			$contador = count($this->cart->contents());
			$i = 1;
			while ($contador >= $i) {
				
				foreach ($this->cart->contents() as $prod) {
					$data['itemId'.$contador] = $prod['id'];
					$data['itemDescription'.$contador] = $prod['name'];
					$data['itemQuantity'.$contador] = $prod['qty'];
					$data['itemAmount'.$contador] = $this->cart->format_number($prod['price']);

					$contador--;
				}
					$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";
			$data = http_build_query($data);

			$curl = curl_init($url);

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

			$xml  = curl_exec($curl);

			curl_close($curl);

			$xml = simplexml_load_string($xml);
			echo $xml->code;

			
		} 
	}
			
			}
		


 ?>

