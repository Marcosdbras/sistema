<?php

class Grupos extends CI_Controller {
    
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
        $this->load->model('grupos_model', '', TRUE);
        $this->data['menuGrupos'] = 'Grupos';
    }

    function index(){
	   $this->gerenciar();
    }

    function gerenciar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar grupos.');
           redirect(base_url());
        }

        $this->load->library('table');
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/grupos/gerenciar/';
        $config['total_rows'] = $this->grupos_model->count('grupos');
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

	    $this->data['results'] = $this->grupos_model->get('grupos','id,descricao,iddetalhe,idusumestre','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'grupos/grupos';
       	$this->load->view('tema/topo',$this->data);
       
		
    }
	
    function adicionar() {

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar grupos.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('grupos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            
            //Author: Marcos Brás--------------------- 
            $this->db->select('idusumestre');
            $this->db->from('grupos');
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
                
                'idusumestre' => $this->session->userdata('idusumestre'),
                'iddetalhe'=>$totreg
            );

            if ($this->grupos_model->add('grupos', $data) == TRUE) {
                $this->session->set_flashdata('success','Grupo adicionado com sucesso!');
                redirect(base_url() . 'index.php/grupos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'grupos/adicionarGrupo';
        $this->load->view('tema/topo', $this->data);
     
    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para editar grupos.');
           redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('grupos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            
            $data = array(
                'descricao' => $this->input->post('descricao'),
                
                'idusumestre' => $this->session->userdata('idusumestre')
            );

            if ($this->grupos_model->edit('grupos', $data, 'id', $this->input->post('id')) == TRUE) {
                $this->session->set_flashdata('success','Grupo editado com sucesso!');
                redirect(base_url() . 'index.php/grupos/editar/'.$this->input->post('id'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->grupos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'grupos/editarGrupo';
        $this->load->view('tema/topo', $this->data);
     
    }


    function visualizar() {
        
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar grupos.');
           redirect(base_url());
        }

        $this->data['result'] = $this->grupos_model->getById($this->uri->segment(3));

        if($this->data['result'] == null){
            $this->session->set_flashdata('error','Grupo não encontrado.');
            redirect(base_url() . 'index.php/grupos/editar/'.$this->input->post('id'));
        }

        $this->data['view'] = 'grupos/visualizarGrupo';
        $this->load->view('tema/topo', $this->data);
     
    }
	
    function excluir(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para excluir grupos.');
           redirect(base_url());
        }

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir produto.');            
            redirect(base_url().'index.php/grupos/gerenciar/');
        }

       
        
        $this->grupos_model->delete('grupos','id',$id);             
        

        $this->session->set_flashdata('success','Grupo excluido com sucesso!');            
        redirect(base_url().'index.php/grupos/gerenciar/');
    }
}

