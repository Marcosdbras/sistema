<?php

class Unidades extends CI_Controller {
    
    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    
    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('unidades_model', '', TRUE);
        $this->data['menuUnidades'] = 'Unidades';
    }

    function index(){
	   $this->gerenciar();
    }

    function gerenciar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vUnidade')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar unidades.');
           redirect(base_url());
        }

        $this->load->library('table');
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/unidades/gerenciar/';
        $config['total_rows'] = $this->unidades_model->count('unidades');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config); 	

	    $this->data['results'] = $this->unidades_model->get('unidades','id,descricao,desc_reduzida,iddetalhe','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'unidades/unidades';
       	$this->load->view('tema/topo',$this->data);
       
		
    }
	
    function adicionar() {

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aUnidade')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar unidades.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('unidades') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            
            //Author: Marcos Brás--------------------- 
            $this->db->select('idusumestre');
            $this->db->from('unidades');
            $this->db->where('idusumestre', $this->session->userdata('idusumestre'));
            $totreg = $this->db->count_all_results()+1;
            /* Caso começar a ocorrer duplicidade de iddetalhe terei que 
               1 - Gravar primeiro todos os dados
               2 - Puxar a última id salvo
               3 - Realizar o count_all
               4 - Por último gravar iddetalhe com total de registro
             */ 
            //----------------------------------------
            
            $data = array(
                'descricao' => set_value('descricao'),
                'desc_reduzida' => $this->input->post('desc_reduzida'),
        
                'idusumestre' => $this->session->userdata('idusumestre'),
                'iddetalhe'=>$totreg
            );

            if ($this->unidades_model->add('unidades', $data) == TRUE) {
                $this->session->set_flashdata('success','Unidade adicionado com sucesso!');
                redirect(base_url() . 'index.php/unidades/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'unidades/adicionarUnidade';
        $this->load->view('tema/topo', $this->data);
     
    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eUnidade')){
           $this->session->set_flashdata('error','Você não tem permissão para editar unidades.');
           redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('unidades') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
         
            
            $data = array(
                'descricao' => $this->input->post('descricao'),
                'desc_reduzida' => $this->input->post('desc_reduzida'),

                'idusumestre' => $this->session->userdata('idusumestre')
            );

            if ($this->unidades_model->edit('unidades', $data, 'id', $this->input->post('id')) == TRUE) {
                $this->session->set_flashdata('success','Unidade editado com sucesso!');
                redirect(base_url() . 'index.php/unidades/editar/'.$this->input->post('id'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->unidades_model->getById($this->uri->segment(3));

        $this->data['view'] = 'unidades/editarUnidade';
        $this->load->view('tema/topo', $this->data);
     
    }


    function visualizar() {
        
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vUnidade')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar unidades.');
           redirect(base_url());
        }

        $this->data['result'] = $this->unidades_model->getById($this->uri->segment(3));

        if($this->data['result'] == null){
            $this->session->set_flashdata('error','Unidade não encontrado.');
            redirect(base_url() . 'index.php/unidades/editar/'.$this->input->post('id'));
        }

        $this->data['view'] = 'unidades/visualizarUnidade';
        $this->load->view('tema/topo', $this->data);
     
    }
	
    function excluir(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dUnidade')){
           $this->session->set_flashdata('error','Você não tem permissão para excluir unidades.');
           redirect(base_url());
        }

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir unidade.');            
            redirect(base_url().'index.php/unidades/gerenciar/');
        }

       
        
        $this->unidades_model->delete('unidades','id',$id);             
        

        $this->session->set_flashdata('success','Unidade excluido com sucesso!');            
        redirect(base_url().'index.php/unidades/gerenciar/');
    }
}

