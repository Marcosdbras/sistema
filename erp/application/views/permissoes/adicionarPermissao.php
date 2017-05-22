<?php
    $this->db->select('idusumestre, os, venda, comanda');
    $this->db->from('emitente');
    $this->db->where('idusumestre', $this->session->userdata('idusumestre'));
    $this->db->limit(1);
    $emitente = $this->db->get();
                                
    foreach($emitente->result() as $emi){
           $os = $emi->os;
           $comanda = $emi->comanda;
           $venda = $emi->venda;
    }
    
    if (!$emitente->result()){
       $os = 0;
       $comanda = 0;
       $venda = 0; 
        
    }  

?>

<div class="span12" style="margin-left: 0">
    <form action="<?php echo base_url();?>index.php/permissoes/adicionar" id="formPermissao" method="post">

    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-lock"></i>
                </span>
                <h5>Cadastro de Permissão</h5>
            </div>
            <div class="widget-content">
                
                <div class="span6">
                    <label>Nome da Permissão</label>
                    <input name="nome" type="text" id="nome" class="span12" />

                </div>
                <div class="span6">
                    <br/>
                    <label>
                        <input name="marcarTodos" type="checkbox" value="1" id="marcarTodos" />
                        <span class="lbl"> Marcar Todos</span>

                    </label>
                    <br/>
                </div>

                <div class="control-group">
                    <label for="documento" class="control-label"></label>
                    <div class="controls">

                        <table class="table table-bordered">
                            <tbody>
                                <!-- Marcos 
                                   26/02/2017
                                   15/03/2017
                                -->

                                <tr>

                                    <td>
                                        <label>
                                            <input name="vDepartamento" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Departamento</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input name="dDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Departamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vCliente" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Cliente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Cliente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Cliente</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input name="dCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Cliente</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vFornecedor" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Fornecedor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Fornecedor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Fornecedor</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input name="dFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Fornecedor</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                

                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vMarca" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Marca</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aMarca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Marca</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eMarca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Marca</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dMarca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Marca</span>
                                        </label>
                                    </td>
                                 
                                </tr>


                                <tr>

                                    <td>
                                        <label>
                                            <input name="vGrupo" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Grupo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vUnidade" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Unidade</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aUnidade" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Unidade</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eUnidade" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Unidade</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dUnidade" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Unidade</span>
                                        </label>
                                    </td>
                                 
                                </tr>                                
                                
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vProduto" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Produto</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Produto</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Produto</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Produto</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                
                                
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vServico" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Serviço</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        
                                        <label>
                                            <input name="vOs" class="marcar" type="checkbox" checked="checked" value="1" <?php if ($os!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Visualizar OS <?php if ($os!=1){ echo '<SUP>*</SUP>'; }?>  </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aOs" class="marcar" type="checkbox" value="1" <?php if ($os!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Adicionar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eOs" class="marcar" type="checkbox" value="1" <?php if ($os!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Editar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dOs" class="marcar" type="checkbox" value="1" <?php if ($os!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Excluir OS</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        
                                        <label>
                                            <input name="vVenda" class="marcar" type="checkbox" checked="checked" value="1"  <?php if ($venda!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Visualizar Venda  <?php if ($venda!=1){ echo '<SUP>*</SUP>'; }?>  </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aVenda" class="marcar" type="checkbox" value="1"  <?php if ($venda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Adicionar Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eVenda" class="marcar" type="checkbox" value="1" <?php if ($venda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Editar Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dVenda" class="marcar" type="checkbox" value="1" <?php if ($venda!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Excluir Venda</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        
                                        <label>
                                            <input name="vComanda" class="marcar" type="checkbox" checked="checked" value="1"  <?php if ($comanda!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Visualizar Comanda   <?php if ($comanda!=1){ echo '<SUP>*</SUP>'; }?> </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aComanda" class="marcar" type="checkbox" value="1"  <?php if ($comanda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Adicionar Comanda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eComanda" class="marcar" type="checkbox" value="1" <?php if ($comanda!=1){ echo 'disabled'; }?> />
                                            <span class="lbl"> Editar Comanda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dComanda" class="marcar" type="checkbox" value="1" <?php if ($comanda!=1){ echo 'disabled'; }?>  />
                                            <span class="lbl"> Excluir Comanda</span>
                                        </label>
                                    </td>
                                 
                                </tr>                                
                                
                                <tr><td colspan="4"></td></tr>
                                
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vArquivo" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Arquivo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="vLancamento" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Lançamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="rCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Cliente</span>
                                        </label>
                                    </td>
                                    
                                    <td>
                                        <label>
                                            <input name="rFornecedor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Fornecedor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="rProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Produto</span>
                                        </label>
                                    </td>
                                    
                                    

                                    <td>
                                        <label>
                                            <input name="rServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Serviço</span>
                                        </label>
                                    </td>


                                 
                                </tr>

                                <tr>
                                    <td>
                                        <label>
                                            <input name="rOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="rVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="rFinanceiro" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Financeiro</span>
                                        </label>
                                    </td>
                                    <td colspan="2"></td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="cUsuario" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Usuário</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cEmitente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Emitente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cPermissao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Permissão</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cBackup" class="marcar" type="checkbox" value="1" />
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
                    <p>* Bloqueado, acesse a opção Emitente no menu lateral para desbloquear a opção desejada</p>
                    
                    <div class="span6 offset3">
                        <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
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

        $(document).on('click', '#marcarTodos', function(event) {
            if($(this).prop('checked')){

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
