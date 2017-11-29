<?php 

    $permissoes = unserialize($result->permissoes);

    $this->db->select('idusumestre, os, venda, comanda, nfe');
    $this->db->from('emitente');
    $this->db->where('idusumestre', $this->session->userdata('idusumestre'));
    $this->db->limit(1);
    $emitente = $this->db->get();
                                
    foreach($emitente->result() as $emi){
           $os = $emi->os;
           $comanda = $emi->comanda;
           $venda = $emi->venda;
           $nfe = $emi->nfe;
    }
    
    if (!$emitente->result()){
       $os = 0;
       $comanda = 0;
       $venda = 0; 
       $nfe =0;
        
    }  

?>
<div class="span12" style="margin-left: 0">
    <form action="<?php echo base_url();?>index.php/permissoes/editar" id="formPermissao" method="post">

    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-lock"></i>
                </span>
                <h5>Editar Permissão</h5>
            </div>
            <div class="widget-content">
                
                <div class="span4">
                    <label>Nome da Permissão</label>
                    <input name="nome" type="text" id="nome" class="span12" value="<?php echo $result->nome; ?>" />
                    <input type="hidden" name="idPermissao" value="<?php echo $result->idPermissao; ?>">

                </div>

                <div class="span3">
                    <label>Situação</label>
                    
                    <select name="situacao" id="situacao" class="span12">
                        <?php if($result->situacao == 1){$sim = 'selected'; $nao ='';}else{$sim = ''; $nao ='selected';}?>
                        <option value="1" <?php echo $sim;?>>Ativo</option>
                        <option value="0" <?php echo $nao;?>>Inativo</option>
                    </select>

                </div>
                <div class="span4">
                    <br/>
                    <label>
                        <input name="" type="checkbox" value="1" id="marcarTodos" />
                        <span class="lbl"> Marcar Todos</span>

                    </label>
                    <br/>
                </div>

                <div class="control-group">
                    <label for="documento" class="control-label"></label>
                    <div class="controls">

                        <table class="table table-bordered">
                            <tbody>
                                
                                <!-- 
                                   27/02/2017 
                                   15/03/2017
                                     Programador: Marcos
                                -->
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vDepartamento'])){ if($permissoes['vDepartamento'] == '1'){echo 'checked';}}?> name="vDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aDepartamento'])){ if($permissoes['aDepartamento'] == '1'){echo 'checked';}}?> name="aDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eDepartamento'])){ if($permissoes['eDepartamento'] == '1'){echo 'checked';}}?> name="eDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Departamento</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dDepartamento'])){ if($permissoes['dDepartamento'] == '1'){echo 'checked';}}?> name="dDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Departamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>                                
                                
                                
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vCliente'])){ if($permissoes['vCliente'] == '1'){echo 'checked';}}?> name="vCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Cliente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aCliente'])){ if($permissoes['aCliente'] == '1'){echo 'checked';}}?> name="aCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Cliente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eCliente'])){ if($permissoes['eCliente'] == '1'){echo 'checked';}}?> name="eCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Cliente</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dCliente'])){ if($permissoes['dCliente'] == '1'){echo 'checked';}}?> name="dCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Cliente</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                
                               
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vFornecedor'])){ if($permissoes['vFornecedor'] == '1'){echo 'checked';}}?> name="vFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Fornecedor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aFornecedor'])){ if($permissoes['aFornecedor'] == '1'){echo 'checked';}}?> name="aFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Fornecedor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eFornecedor'])){ if($permissoes['eFornecedor'] == '1'){echo 'checked';}}?> name="eFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Fornecedor</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dFornecedor'])){ if($permissoes['dFornecedor'] == '1'){echo 'checked';}}?> name="dFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Fornecedor</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                
                                

                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vMarca'])){ if($permissoes['vMarca'] == '1'){echo 'checked';}}?> name="vMarca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Marca</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aMarca'])){ if($permissoes['aMarca'] == '1'){echo 'checked';}}?> name="aMarca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Marca</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eMarca'])){ if($permissoes['eMarca'] == '1'){echo 'checked';}}?> name="eMarca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Marca</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dMarca'])){ if($permissoes['dMarca'] == '1'){echo 'checked';}}?> name="dMarca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Marca</span>
                                        </label>
                                    </td>
                                 
                                </tr>                                


                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vGrupo'])){ if($permissoes['vGrupo'] == '1'){echo 'checked';}}?> name="vGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aGrupo'])){ if($permissoes['aGrupo'] == '1'){echo 'checked';}}?> name="aGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eGrupo'])){ if($permissoes['eGrupo'] == '1'){echo 'checked';}}?> name="eGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dGrupo'])){ if($permissoes['dGrupo'] == '1'){echo 'checked';}}?> name="dGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Grupo</span>
                                        </label>
                                    </td>
                                 
                                </tr>


                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vUnidade'])){ if($permissoes['vUnidade'] == '1'){echo 'checked';}}?> name="vUnidade" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Unidade</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aUnidade'])){ if($permissoes['aUnidade'] == '1'){echo 'checked';}}?> name="aUnidade" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Unidade</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eUnidade'])){ if($permissoes['eUnidade'] == '1'){echo 'checked';}}?> name="eUnidade" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Unidade</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dUnidade'])){ if($permissoes['dUnidade'] == '1'){echo 'checked';}}?> name="dUnidade" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Unidade</span>
                                        </label>
                                    </td>
                                 
                                </tr>


                                
                                
                                
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vProduto'])){ if($permissoes['vProduto'] == '1'){echo 'checked';}}?> name="vProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Produto</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aProduto'])){ if($permissoes['aProduto'] == '1'){echo 'checked';}}?> name="aProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Produto</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eProduto'])){ if($permissoes['eProduto'] == '1'){echo 'checked';}}?> name="eProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Produto</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dProduto'])){ if($permissoes['dProduto'] == '1'){echo 'checked';}}?> name="dProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Produto</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vServico'])){ if($permissoes['vServico'] == '1'){echo 'checked';}}?> name="vServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aServico'])){ if($permissoes['aServico'] == '1'){echo 'checked';}}?> name="aServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eServico'])){ if($permissoes['eServico'] == '1'){echo 'checked';}}?> name="eServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dServico'])){ if($permissoes['dServico'] == '1'){echo 'checked';}}?> name="dServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Serviço</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vOs'])){ if($permissoes['vOs'] == '1'){echo 'checked';}}?> name="vOs" class="marcar" type="checkbox" value="1"   <?php if ($os!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Visualizar OS  <?php if ($os!=1){ echo '<SUP>*</SUP>'; }?> </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aOs'])){ if($permissoes['aOs'] == '1'){echo 'checked';}}?> name="aOs" class="marcar" type="checkbox" value="1" <?php if ($os!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Adicionar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eOs'])){ if($permissoes['eOs'] == '1'){echo 'checked';}}?> name="eOs" class="marcar" type="checkbox" value="1" <?php if ($os!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Editar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dOs'])){ if($permissoes['dOs'] == '1'){echo 'checked';}}?> name="dOs" class="marcar" type="checkbox" value="1" <?php if ($os!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Excluir OS</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vVenda'])){ if($permissoes['vVenda'] == '1'){echo 'checked';}}?> name="vVenda" class="marcar" type="checkbox" value="1" <?php if ($venda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Visualizar Venda <?php if ($venda!=1){ echo '<SUP>*</SUP>'; }?>  </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aVenda'])){ if($permissoes['aVenda'] == '1'){echo 'checked';}}?> name="aVenda" class="marcar" type="checkbox" value="1" <?php if ($venda!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Adicionar Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eVenda'])){ if($permissoes['eVenda'] == '1'){echo 'checked';}}?> name="eVenda" class="marcar" type="checkbox" value="1" <?php if ($venda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Editar Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dVenda'])){ if($permissoes['dVenda'] == '1'){echo 'checked';}}?> name="dVenda" class="marcar" type="checkbox" value="1" <?php if ($venda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Excluir Venda</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                 <tr>

                                    <td>
                                        
                                        <label>
                                            <input  <?php if(isset($permissoes['vComanda'])){ if($permissoes['vComanda'] == '1'){echo 'checked';}}?>   name="vComanda" class="marcar" type="checkbox" checked="checked" value="1"  <?php if ($comanda!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Visualizar Comanda   <?php if ($comanda!=1){ echo '<SUP>*</SUP>'; }?> </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aComanda'])){ if($permissoes['aComanda'] == '1'){echo 'checked';}}?>   name="aComanda" class="marcar" type="checkbox" value="1"  <?php if ($comanda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Adicionar Comanda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eComanda'])){ if($permissoes['eComanda'] == '1'){echo 'checked';}}?>    name="eComanda" class="marcar" type="checkbox" value="1" <?php if ($comanda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Editar Comanda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dComanda'])){ if($permissoes['dComanda'] == '1'){echo 'checked';}}?>   name="dComanda" class="marcar" type="checkbox" value="1" <?php if ($comanda!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Excluir Comanda</span>
                                        </label>
                                    </td>
                                 
                                </tr> 
                                
                                
                                
                                
                                <tr><td colspan="4"></td></tr>




                                 <tr>

                                    <td>
                                        
                                        <label>
                                            <input  <?php if(isset($permissoes['vNfe'])){ if($permissoes['vNfe'] == '1'){echo 'checked';}}?>   name="vNfe" class="marcar" type="checkbox" checked="checked" value="1"  <?php if ($nfe!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Visualizar Nfe   <?php if ($nfe!=1){ echo '<SUP>*</SUP>'; }?> </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aNfe'])){ if($permissoes['aNfe'] == '1'){echo 'checked';}}?>   name="aNfe" class="marcar" type="checkbox" value="1"  <?php if ($nfe!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Adicionar Nfe</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eNfe'])){ if($permissoes['eNfe'] == '1'){echo 'checked';}}?>    name="eNfe" class="marcar" type="checkbox" value="1" <?php if ($nfe!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Editar Nfe</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dNfe'])){ if($permissoes['dNfe'] == '1'){echo 'checked';}}?>   name="dNfe" class="marcar" type="checkbox" value="1" <?php if ($nfe!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Excluir Nfe</span>
                                        </label>
                                    </td>
                                 
                                </tr> 
                                
                                
                                
                                
                                <tr><td colspan="4"></td></tr>










                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vArquivo'])){ if($permissoes['vArquivo'] == '1'){echo 'checked';}}?> name="vArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aArquivo'])){ if($permissoes['aArquivo'] == '1'){echo 'checked';}}?> name="aArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eArquivo'])){ if($permissoes['eArquivo'] == '1'){echo 'checked';}}?> name="eArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dArquivo'])){ if($permissoes['dArquivo'] == '1'){echo 'checked';}}?> name="dArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Arquivo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vLancamento'])){ if($permissoes['vLancamento'] == '1'){echo 'checked';}}?> name="vLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aLancamento'])){ if($permissoes['aLancamento'] == '1'){echo 'checked';}}?> name="aLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eLancamento'])){ if($permissoes['eLancamento'] == '1'){echo 'checked';}}?> name="eLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dLancamento'])){ if($permissoes['dLancamento'] == '1'){echo 'checked';}}?> name="dLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Lançamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rCliente'])){ if($permissoes['rCliente'] == '1'){echo 'checked';}}?> name="rCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Cliente</span>
                                        </label>
                                    </td>
                                    
                                    
                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rFornecedor'])){ if($permissoes['rFornecedor'] == '1'){echo 'checked';}}?> name="rFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Fornecedor</span>
                                        </label>
                                    </td>
                                    
                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rProduto'])){ if($permissoes['rProduto'] == '1'){echo 'checked';}}?> name="rProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Produto</span>
                                        </label>
                                    </td>
                                    

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rServico'])){ if($permissoes['rServico'] == '1'){echo 'checked';}}?> name="rServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Serviço</span>
                                        </label>
                                    </td>


                                 
                                </tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rOs'])){ if($permissoes['rOs'] == '1'){echo 'checked';}}?> name="rOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório OS</span>
                                        </label>
                                    </td>



                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rVenda'])){ if($permissoes['rVenda'] == '1'){echo 'checked';}}?> name="rVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rFinanceiro'])){ if($permissoes['rFinanceiro'] == '1'){echo 'checked';}}?> name="rFinanceiro" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Financeiro</span>
                                        </label>
                                    </td>
                                    <td colspan="2"></td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cUsuario'])){ if($permissoes['cUsuario'] == '1'){echo 'checked';}}?> name="cUsuario" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Usuário</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cEmitente'])){ if($permissoes['cEmitente'] == '1'){echo 'checked';}}?> name="cEmitente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Emitente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cPermissao'])){ if($permissoes['cPermissao'] == '1'){echo 'checked';}}?> name="cPermissao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Permissão</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cBackup'])){ if($permissoes['cBackup'] == '1'){echo 'checked';}}?> name="cBackup" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Backup</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

              
    
            <div class="form-actions">
                <div class="span12">
                    <div class="span6 offset3">
                        <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                        <a href="<?php echo base_url() ?>index.php/permissoes" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                    </div>
                </div>
            </div>
           
            </div>
        </div>

                   
    </div>

</form>

</div>


<script type="text/javascript" src="<?php echo base_url()?>assets/js/validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){


        $("#marcarTodos").click(function(){

            if ($(this).attr("checked")){
              $('.marcar').each(
                 function(){
                    $(this).attr("checked", true);
                 }
              );
           }else{
              $('.marcar').each(
                 function(){
                    $(this).attr("checked", false);
                 }
              );
           }

        });   


 
    $("#formPermissao").validate({
        rules :{
            nome: {required: true}
        },
        messages:{
            nome: {required: 'Campo obrigatório'}
        }
    });     

        

    });
</script>
