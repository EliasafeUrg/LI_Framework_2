<?php 


namespace Core;

class Route{

	private $controller = "welcome";
	private $method = "index";
	private $param = [];


	public function __construct(){
		$url = $this->getUrl();

		

		if(file_exists("app/controllers/{$url[0]}.php")):
			$this->controller = $url[0];
		unset($url[0]);
		else:
			$error = "Controller";
			require "errors/not_found_model.php";
			exit();

		endif;

		require "app/controllers/{$this->controller}.php";

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
					$error = "Metodo";
					require "errors/not_found_model.php";
					exit();
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