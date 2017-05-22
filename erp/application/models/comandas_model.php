<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comandas_model extends CI_Model {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */

	function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $idusumestre = $this->session->userdata('idusumestre');
        
        $this->db->select($fields.', clientes.nomeCliente, clientes.idClientes');
        $this->db->from($table);
        $this->db->where($table.'.idusumestre',$idusumestre);
        $this->db->limit($perpage,$start);
        $this->db->join('clientes', 'clientes.idClientes = '.$table.'.clientes_id');
        //$this->db->order_by('idVendas','desc');
        $this->db->order_by($table.'.iddetalhe','desc');
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $this->db->select('vendas.*, clientes.*, usuarios.*');
        $this->db->from('vendas');
        $this->db->join('clientes','clientes.idClientes = vendas.clientes_id');
        $this->db->join('usuarios','usuarios.idUsuarios = vendas.usuarios_id');
        $this->db->where('vendas.idVendas',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function getProdutos($id = null){
        $this->db->select('itens_de_vendas.*, produtos.*');
        $this->db->from('itens_de_vendas');
        $this->db->join('produtos','produtos.idProdutos = itens_de_vendas.produtos_id');
        $this->db->where('vendas_id',$id);
        return $this->db->get()->result();
    }

    
    function add($table,$data,$returnId = false){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
                        if($returnId == true){
                            return $this->db->insert_id($table);
                        }
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        
        
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        
        
        
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }   

    function count($table){
        $idusumestre = $this->session->userdata('idusumestre');
        
	return $this->db->count_all($table);
    }

    public function autoCompleteProduto($q){
        
        $idusumestre = $this->session->userdata('idusumestre');

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->where('idusumestre',$idusumestre);
        $this->db->like('descricao', $q);
        $query = $this->db->get('produtos');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['descricao'].' | Preço: R$ '.$row['precoComanda'].' | Estoque: '.$row['estoque'].' '.$row['unidade'],'estoque'=>$row['estoque'],'unidade'=>$row['unidade'],'id'=>$row['idProdutos'],'preco'=>$row['precoComanda']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteCliente($q){
        
        $idusumestre = $this->session->userdata('idusumestre');

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->where('idusumestre',$idusumestre);
        
        
        $this->db->like('nomeCliente', $q);
        $query = $this->db->get('clientes');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nomeCliente'].' | Telefone: '.$row['telefone'],'id'=>$row['idClientes']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteUsuario($q){
        
        $idusumestre = $this->session->userdata('idusumestre');
        
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->where('idusumestre',$idusumestre);
        $this->db->where('mestre','N');
        $this->db->like('nome', $q);
        $this->db->where('situacao',1);
        $query = $this->db->get('usuarios');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nome'].' | Telefone: '.$row['telefone'],'id'=>$row['idUsuarios']);
            }
            echo json_encode($row_set);
        }
    }


    public function atender($q){
       $idusumestre = $this->session->userdata('idusumestre');
       $this->db->select('*');       
       $this->db->where('idusumestre',$idusumestre);
       $this->db->where('id',$q);
       $this->db->limit(1);
       $query = $this->db->get('departamentos');
       
       echo '<option value="-1" selected="selected"></option>'; 
       
       if($query->num_rows > 0){
         foreach($query->result_array() as $row){
             $row_set[] = array('id'=>$row['id'], 
                                'descricao'=>$row['descricao'], 
                                'desc_ponto_atendimento'=>$row['desc_ponto_atendimento'], 
                                'ponto_inicial'=>$row['ponto_inicial'], 
                                'ponto_final'=>$row['ponto_final']);
             
             
             if($row['ponto_inicial']>0 &&  $row['ponto_final']>0 &&  $row['ponto_inicial'] <= $row['ponto_final']){

                 for($i=$row['ponto_inicial'];$i<=$row['ponto_final'];$i++){
                  echo '<option value="'.$i.'"> '.$row['desc_ponto_atendimento'].' '.$i.' </option>'; 
                  
                }    
                 
             }
             
         }  
         //echo json_encode($row_set);
         //echo '<option value="1">Teste2</option>';
           
       }
        
    }
    

}

/* End of file comandas_model.php */
/* Location: ./application/models/comandas_model.php */