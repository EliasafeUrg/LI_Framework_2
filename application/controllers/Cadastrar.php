<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cadastrar extends CI_Controller{


		public function produto(){
			$this->load->library('form_validation');
			$this->load->model("Model_Categoria","categoria");
			$dados = [
				"page" => "cadastrar_produto",
				"title" => "HOME PAGE LOJA",
				"mensagem" => null,
				'categorias' => $this->categoria->listar_categoria(),
			];

			if($this->input->post("cadastrar") == "Cadastrar Produto"):
		
				

			    $this->form_validation->set_rules('produto', 'Produto', 'required|is_unique[produto.ProdNome]');
			    $this->form_validation->set_rules('descricao', 'Descricao', 'required');
			    $this->form_validation->set_rules('preco_venda', 'Preço', 'required');
			    $this->form_validation->set_rules('categoria', 'Categoria', 'required');
			    $this->form_validation->set_rules('preco_custo', 'Custo', 'required');
			    $this->form_validation->set_rules('descricao', 'Descriaao', 'required');

			  if ($this->form_validation->run() == FALSE)
                {
                        $dados['mensagem'] = validation_errors();
                }
                else
                {
                	$this->load->model("Produtos_loja");
                	if($this->Produtos_loja->cadastrar_produto()):
						$dados['mensagem'] = "<strong>".$this->input->post('produto')."</strong> foi Cadastrado Com Sucesso";
					endif;
                }


			endif;


			$this->load->view("Admin/Admin", $dados);


		}


		public function categoria(){
			$this->load->library('pagination');
			$this->load->model("Model_Categoria","categoria");
			$config['per_page'] = 4;
			$config['base_url'] = '/loja/cadastrar/categoria/';
			$config['total_rows'] = count($this->categoria->listar_categoria());
			$quantidade = $config['per_page'];
			($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0;

			
			$dados = [
				"page" => "cadastrar_categoria",
				"title" => "HOME PAGE LOJA",
				"mensagem" => null,
				'categorias' => $this->categoria->listar_categoria($quantidade,$inicio),
			];

	
		

		
			$this->pagination->initialize($config);

			$dados['pagination'] = $this->pagination->create_links();

		

		
						
			if($this->input->post("cadastrar") == "Cadastrar Categoria"):
				$this->load->library('form_validation');

			 $this->form_validation->set_rules('categoria', 'Categoria', 'required|is_unique[categoria_produtos.categoria]');

			  if ($this->form_validation->run() == FALSE)
                {
                        $dados['mensagem'] = validation_errors();
                }
                else
                {
                       
					$this->load->model("Model_Categoria","categoria");
					if($this->categoria->cadastrar()):
						$dados['categorias'] = $this->categoria->listar_categoria();

					$dados['mensagem'] = $this->input->post('categoria')." foi Cadastrado Com Sucesso";
					else:
						$dados['mensagem'] = "Falha no registro";
					endif;
                }


			endif;

			$this->load->view("Admin/Admin", $dados);


		}


	}


 ?>