<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="icon-list"></i></span><h5>Dados do Produto</h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Descrição</strong></td>
                            <td><?php echo $result->descricao ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Unidade</strong></td>
                            <td><?php echo $result->unidade ?></td>
                        </tr>
                        
                        <tr>
                            <td style="text-align: right"><strong>Marca</strong></td>
                            <td>
                                <?php 
                                    $this->db->select('idusumestre, iddetalhe, descricao, id');
                                    $this->db->from('marcas');
                                    $this->db->where('idusumestre', $this->session->userdata('idusumestre'));
                                    $this->db->where('id',$result->idmarca);
                                    $this->db->limit(1);
                                    $marcas = $this->db->get();
                               
                                
                                    foreach($marcas->result() as $mar){
                                       echo $mar->descricao;  
                                    } 
                                    
                                ?>
                            </td>
                        </tr>

                        
                        <tr>
                            <td style="text-align: right"><strong>Grupo</strong></td>
                            <td>
                                <?php 
                                    $this->db->select('idusumestre, iddetalhe, descricao, id');
                                    $this->db->from('grupos');
                                    $this->db->where('idusumestre', $this->session->userdata('idusumestre'));
                                    $this->db->where('id',$result->idgrupo);
                                    $this->db->limit(1);
                                    $grupos = $this->db->get();
                               
                                
                                    foreach($grupos->result() as $gru){
                                       echo $gru->descricao;  
                                    } 
                                    
                                ?>
                            </td>
                        </tr>
                        
                        


                        
                        
                        <tr>
                            <td style="text-align: right"><strong>Preço de Compra</strong></td>
                            <td>R$ <?php echo number_format($result->precoCompra,2,',',''); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de Venda</strong></td>
                            <td>R$ <?php echo  number_format($result->precoVenda,2,',',''); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque</strong></td>
                            <td><?php echo  round($result->estoque,0)  ; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque Mínimo</strong></td>
                            <td><?php echo round($result->estoqueMinimo,0) ; ?></td>
                        </tr>
                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

