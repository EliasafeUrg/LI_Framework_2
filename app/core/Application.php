<?php 
	

	namespace app\core;
	
	class Application{

		private $controller = "welcome";
		private $method;
		private $param = [];


		public function __construct(){
			$url = $this->getUrl();
			
			if(file_exists("app/controller/{$url[0]}.php")):
				$this->controller = $url[0];
				unset($url[0]);
				else:
					exit("App/Controller/ - path error 404 not found");
					
			endif;



			require "app/controller/{$this->controller}.php";

			$this->controller = new $this->controller;

			if(isset($url[1])):
				if(method_exists($this->controller, $url[1])):
					$this->method = $url[1];
					unset($url[1]);
				else:
					$url = $this->getUrl();
				
					if((!$url[1])):
						$this->method = "index";
					else:
						exit("Metodo não encontrado em Controller: ".$url[0]);
						unset($url);

					endif;	

				endif;
			endif;

			$this->param = $url ? array_values($url) : [];

			call_user_func_array([$this->controller, $this->method], $this->param);
			
		}


		public function getUrl(){
			
			if(isset($_GET['url'])):
				return explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
			endif;

		}


	}


 ?>