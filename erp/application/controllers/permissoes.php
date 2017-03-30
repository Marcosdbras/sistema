<?php

class Permissoes extends CI_Controller {
    

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

      if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao')){
        $this->session->set_flashdata('error','Você não tem permissão para configurar as permissões no sistema.');
        redirect(base_url());
      }

      $this->load->helper(array('form', 'codegen_helper'));
      $this->load->model('permissoes_model', '', TRUE);
      $this->data['menuConfiguracoes'] = 'Permissões';
  }
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){
        
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/permissoes/gerenciar/';
        $config['total_rows'] = $this->permissoes_model->count('permissoes');
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

		  $this->data['results'] = $this->permissoes_model->get('permissoes','idPermissao,nome,data,situacao, iddetalhe','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'permissoes/permissoes';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
    function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomePermissao = $this->input->post('nome');
            $cadastro = date('Y-m-d');
            $situacao = 1;

            $permissoes = array(

                 /* 
                  * 26/02/2017
                  * 15/03/2017
                     Programador: Marcos 
                  */
                
                  'aDepartamento' => $this->input->post('aDepartamento'),
                  'eDepartamento' => $this->input->post('eDepartamento'),
                  'dDepartamento' => $this->input->post('dDepartamento'),
                  'vDepartamento' => $this->input->post('vDepartamento'),        
                

                  'aCliente' => $this->input->post('aCliente'),
                  'eCliente' => $this->input->post('eCliente'),
                  'dCliente' => $this->input->post('dCliente'),
                  'vCliente' => $this->input->post('vCliente'),                 
                
                  'aFornecedor' => $this->input->post('aFornecedor'),
                  'eFornecedor' => $this->input->post('eFornecedor'),
                  'dFornecedor' => $this->input->post('dFornecedor'),
                  'vFornecedor' => $this->input->post('vFornecedor'),
                
                  /* ---- */
                  'aGrupo' => $this->input->post('aGrupo'),
                  'eGrupo' => $this->input->post('eGrupo'),
                  'dGrupo' => $this->input->post('dGrupo'),
                  'vGrupo' => $this->input->post('vGrupo'),
                
                  'aMarca' => $this->input->post('aMarca'),
                  'eMarca' => $this->input->post('eMarca'),
                  'dMarca' => $this->input->post('dMarca'),
                  'vMarca' => $this->input->post('vMarca'),                
                
                
                  'aProduto' => $this->input->post('aProduto'),
                  'eProduto' => $this->input->post('eProduto'),
                  'dProduto' => $this->input->post('dProduto'),
                  'vProduto' => $this->input->post('vProduto'),

                  'aServico' => $this->input->post('aServico'),
                  'eServico' => $this->input->post('eServico'),
                  'dServico' => $this->input->post('dServico'),
                  'vServico' => $this->input->post('vServico'),

                  'aOs' => $this->input->post('aOs'),
                  'eOs' => $this->input->post('eOs'),
                  'dOs' => $this->input->post('dOs'),
                  'vOs' => $this->input->post('vOs'),

                  'aVenda' => $this->input->post('aVenda'),
                  'eVenda' => $this->input->post('eVenda'),
                  'dVenda' => $this->input->post('dVenda'),
                  'vVenda' => $this->input->post('vVenda'),

                  'aArquivo' => $this->input->post('aArquivo'),
                  'eArquivo' => $this->input->post('eArquivo'),
                  'dArquivo' => $this->input->post('dArquivo'),
                  'vArquivo' => $this->input->post('vArquivo'),

                  'aLancamento' => $this->input->post('aLancamento'),
                  'eLancamento' => $this->input->post('eLancamento'),
                  'dLancamento' => $this->input->post('dLancamento'),
                  'vLancamento' => $this->input->post('vLancamento'),

                  'cUsuario' => $this->input->post('cUsuario'),
                  'cEmitente' => $this->input->post('cEmitente'),
                  'cPermissao' => $this->input->post('cPermissao'),
                  'cBackup' => $this->input->post('cBackup'),

                  'rCliente' => $this->input->post('rCliente'),
                  
                               
                  'rFornecedor' => $this->input->post('rFornecedor'),                
                
                  'rProduto' => $this->input->post('rProduto'),
                  'rServico' => $this->input->post('rServico'),
                  'rOs' => $this->input->post('rOs'),
                  'rVenda' => $this->input->post('rVenda'),
                  'rFinanceiro' => $this->input->post('rFinanceiro'),

            );
            $permissoes = serialize($permissoes);

            //Author: Marcos Brás--------------------- 
            $this->db->select('idusumestre');
            $this->db->from('permissoes');
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
                'nome' => $nomePermissao,
                'data' => $cadastro,
                'permissoes' => $permissoes,
                'situacao' => $situacao,
                'idusumestre' => $this->session->userdata('idusumestre'),
                'iddetalhe'=>$totreg
            );

            if ($this->permissoes_model->add('permissoes', $data) == TRUE) {

                $this->session->set_flashdata('success', 'Permissão adicionada com sucesso!');
                redirect(base_url() . 'index.php/permissoes/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'permissoes/adicionarPermissao';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        //if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
        //    $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente. '.$this->uri->total_segments());
        //    redirect('mapos');
        //}
        
        //$this->session->set_flashdata('success', $this->uri->total_segments() );
        
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomePermissao = $this->input->post('nome');
            $situacao = $this->input->post('situacao');
            $permissoes = array(
                   /* Marcos 
                   * 26/02/2017
                   * 15/02/2017
                   */ 
                  'aDepartamento' => $this->input->post('aDepartamento'),
                  'eDepartamento' => $this->input->post('eDepartamento'),
                  'dDepartamento' => $this->input->post('dDepartamento'),
                  'vDepartamento' => $this->input->post('vDepartamento'),
                
                  'aCliente' => $this->input->post('aCliente'),
                  'eCliente' => $this->input->post('eCliente'),
                  'dCliente' => $this->input->post('dCliente'),
                  'vCliente' => $this->input->post('vCliente'),                               
                
                  'aFornecedor' => $this->input->post('aFornecedor'),
                  'eFornecedor' => $this->input->post('eFornecedor'),
                  'dFornecedor' => $this->input->post('dFornecedor'),
                  'vFornecedor' => $this->input->post('vFornecedor'),
                
                  'aProduto' => $this->input->post('aProduto'),
                  'eProduto' => $this->input->post('eProduto'),
                  'dProduto' => $this->input->post('dProduto'),
                  'vProduto' => $this->input->post('vProduto'),
                
                  'aGrupo' => $this->input->post('aGrupo'),
                  'eGrupo' => $this->input->post('eGrupo'),
                  'dGrupo' => $this->input->post('dGrupo'),
                  'vGrupo' => $this->input->post('vGrupo'),
                
                  'aMarca' => $this->input->post('aMarca'),
                  'eMarca' => $this->input->post('eMarca'),
                  'dMarca' => $this->input->post('dMarca'),
                  'vMarca' => $this->input->post('vMarca'),
                
                  'aUnidade' => $this->input->post('aUnidade'),
                  'eUnidade' => $this->input->post('eUnidade'),
                  'dUnidade' => $this->input->post('dUnidade'),
                  'vUnidade' => $this->input->post('vUnidade'),
                
                

                  'aServico' => $this->input->post('aServico'),
                  'eServico' => $this->input->post('eServico'),
                  'dServico' => $this->input->post('dServico'),
                  'vServico' => $this->input->post('vServico'),

                  'aOs' => $this->input->post('aOs'),
                  'eOs' => $this->input->post('eOs'),
                  'dOs' => $this->input->post('dOs'),
                  'vOs' => $this->input->post('vOs'),

                  'aVenda' => $this->input->post('aVenda'),
                  'eVenda' => $this->input->post('eVenda'),
                  'dVenda' => $this->input->post('dVenda'),
                  'vVenda' => $this->input->post('vVenda'),

                  'aArquivo' => $this->input->post('aArquivo'),
                  'eArquivo' => $this->input->post('eArquivo'),
                  'dArquivo' => $this->input->post('dArquivo'),
                  'vArquivo' => $this->input->post('vArquivo'),

                  'aLancamento' => $this->input->post('aLancamento'),
                  'eLancamento' => $this->input->post('eLancamento'),
                  'dLancamento' => $this->input->post('dLancamento'),
                  'vLancamento' => $this->input->post('vLancamento'),

                  'cUsuario' => $this->input->post('cUsuario'),
                  'cEmitente' => $this->input->post('cEmitente'),
                  'cPermissao' => $this->input->post('cPermissao'),
                  'cBackup' => $this->input->post('cBackup'),

                  'rCliente' => $this->input->post('rCliente'),
                  
                  //26/02/2017
                  'rFornecedor' => $this->input->post('rFornecedor'),
                
                  'rProduto' => $this->input->post('rProduto'),
                  'rServico' => $this->input->post('rServico'),
                  'rOs' => $this->input->post('rOs'),
                  'rVenda' => $this->input->post('rVenda'),
                  'rFinanceiro' => $this->input->post('rFinanceiro'),

            );
            $permissoes = serialize($permissoes);

            $data = array(
                'nome' => $nomePermissao,
                'permissoes' => $permissoes,
                'situacao' => $situacao,
                'idusumestre' => $this->session->userdata('idusumestre')
            );

            if ($this->permissoes_model->edit('permissoes', $data, 'idPermissao', $this->input->post('idPermissao')) == TRUE) {
                $this->session->set_flashdata('success', 'Permissão editada com sucesso!');
                redirect(base_url() . 'index.php/permissoes/editar/'.$this->input->post('idPermissao'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->permissoes_model->getById($this->uri->segment(3));

        $this->data['view'] = 'permissoes/editarPermissao';
        $this->load->view('tema/topo', $this->data);

    }
	
    function desativar(){

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar desativar permissão.');            
            redirect(base_url().'index.php/permissoes/gerenciar/');
        }

        //$this->db->where('permissoes_id', $id);
        //$this->db->delete('servi_os');

        $this->permissoes_model->delete('permissoes','idPermissao',$id);             
        

        $this->session->set_flashdata('success','Permissão excluida com sucesso!');            
        redirect(base_url().'index.php/permissoes/gerenciar/');
    }
}


/* End of file permissoes.php */
/* Location: ./application/controllers/permissoes.php */