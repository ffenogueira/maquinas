<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinas extends CI_Controller {



	public function __construct(){
		parent::__construct();

		$this->load->model("Maquinas_model","maquinas");
		$this->load->model("MaquinasServerSide_model","maquinas_ss");
	}

	public function index()
	{

		$this->load->view('menu');
	}

	public function entrada()
	{
		$dados["unidades"] = $this->util->unidades();

		if($_POST){
			
			$this->session->set_flashdata('message', array("type" => "success", "message" => "Salvo"));
			$this->maquinas->entrada($_POST);
		}

		$this->load->view('entrada',$dados);
	}


	public function listarEntrada()
	{
	

		$dados = array();
		$this->load->view('listarEntrada',$dados);
	}




	public function saida()
	{
	
		$dados = array();
		if($_POST){
			
			$this->session->set_flashdata('message', array("type" => "success", "message" => "Salvo"));
			$this->maquinas->saida($_POST);
		}

		$this->load->view('saida',$dados);
	}

	public function listarSaida()
	{
	

		$dados = array();
		$this->load->view('listarSaida',$dados);
	}


	public function getlista(){

		$lista = $this->maquinas_ss->get_datatables();
		$data = array();

		foreach ($lista as $ls) {

			$row = array();


			$row[] = $ls->id;
			$row[] = $ls->unidade;
			$row[] = $ls->num_serie;
			$row[] = $ls->rg_entrega;
			$row[] = $ls->data_entrada;
			$row[] = $ls->observacao;
			$row[] = $ls->rg_usuario;

			$data[] = $row;

		}

		$nFiltrados = $this->maquinas_ss->count_filtered();
		$ntotal = $this->maquinas_ss->count_all();

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $nFiltrados,
			"recordsFiltered" => $ntotal,
			"data" => $data
		);

		echo json_encode($output);
	}

	 public function ajax_list()
    {
        $list = $this->maquinas_ss->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $maquinas_ss) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $maquinas_ss->id;
            $row[] = $maquinas_ss->unidade;
            $row[] = $maquinas_ss->num_serie;
            $row[] = $maquinas_ss->rg_entrega;
            $row[] = $maquinas_ss->data_entrada;
            $row[] = $maquinas_ss->observacao;
            $row[] = $maquinas_ss->rg_usuario;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->maquinas_ss->count_all(),
                        "recordsFiltered" => $this->maquinas_ss->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 



	
}
