<?php
require_once '../biblioteca/read.data.php';
require_once '../biblioteca/funcoes.php';

require '../erp/setupConstante/configuracao.php';

//Substituir chamada Jquery que está dentro de MAPOS pelo da pasta stylebootstrap 
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script  type="text/javascript" src="../../../../stylebootstrap/number/jquery.number.min.js"></script>

<?php
//Funções em geral
js_funcoes();

// Evento dos campos
js_aoSairDoCampo();
js_aoEntrarNoCampo();
?>

<?php
// Buscar informação 
$this->db->select('vendas.idVendas, vendas.iddetalhe');
$this->db->from('vendas');
$this->db->where('idVendas', $result->idVendas);
$this->db->limit('1');

$query = $this->db->get();

$row = $query->row();

$nvenda = $row->iddetalhe;
?>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar Pedido</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab"><strong>Detalhe da Venda</strong> </a></li>
                        <li  id="tabDetalhes3"><a href="#tab2" data-toggle="tab">  <strong>Lançar Comanda</strong> </a></li>                       
                        <li  id="tabDetalhes2"><a href="#tab3" data-toggle="tab">  <strong>Produtos</strong>  </a></li> 
                        

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divEditarVenda">

                                <form action="<?php echo current_url(); ?>" method="post"  onsubmit="return validarDados();"  id="formVendas">
                                    <?php echo form_hidden('idVendas', $result->idVendas) ?>

                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Venda: 
                                            <?php
                                            echo $nvenda;
                                            ?>
                                        </h3>

                                        <div class="row-fluid" >

                                            <div class="span2" style="margin-left: 0">
                                                <label for="dataFinal">Data da Venda</label>
                                                <input id="dataVenda" class="span12 datepicker" type="text" name="dataVenda" value="<?php echo date('d/m/Y', strtotime($result->dataVenda)); ?>"  />
                                            </div>

                                            <div class="span5">
                                                <label for="tecnico">Responsável<span class="required">*</span></label>
                                                <input id="tecnico" class="span12" type="text" name="tecnico" value="<?php echo $result->nome ?>"  />
                                                <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>"  />
                                            </div>                  

                                            <div class="span5" >
                                                <label for="cliente">Cliente<span class="required">*</span></label>
                                                <input id="cliente" class="span12" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>"  />
                                                <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="<?php echo $result->clientes_id ?>"  />
                                                <input id="valorTotal" type="hidden" name="valorTotal" value=""  />
                                            </div>




                                        </div>

                                        <div class="row-fluid">

                                            <div class="span12" style="padding: 1%">

                                                <div class="span6">
                                                    <label for="departamento">Local de Atendimento<span class="required">*</span> </label> 

                                                    <select class="span12"  id="departamento"  name="departamento"  >
                                                        <option value="-1" selected="selected"></option>
                                                        <?php
                                                        $this->db->select('id, idusumestre, iddetalhe, descricao, desc_ponto_atendimento, ponto_inicial, ponto_final');
                                                        $this->db->from('departamentos');
                                                        $this->db->where('idusumestre', $this->session->userdata('idusumestre'));
                                                        $departamento = $this->db->get();

                                                        foreach ($departamento->result() as $depto) {
                                                            echo '<option value="' . $depto->id . '">' . $depto->descricao . '</option>';
                                                        }
                                                        ?>

                                                    </select>

                                                </div>

                                                <div class="span6">
                                                    <label for="atender">Ponto de Atendimento <span class="required">*</span></label>
                                                    <select class="span12" id="atender" name="atender">

                                                    </select>
                                                </div>


                                            </div>  
                                            
                                        </div>    



                                    </div>

                                    <div class="span12" style="padding: 1%; margin-left: 0">

                                        <div class="span8 offset2" style="text-align: center">
                                            <?php if ($result->faturado == 0) { ?>
                                                <a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="btn btn-success"><i class="icon-file"></i> Faturar</a>
                                            <?php } ?>
                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            <a href="<?php echo base_url() ?>index.php/comandas/visualizar/<?php echo $result->idVendas; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Visualizar Venda</a>
                                            <a href="<?php echo base_url() ?>index.php/comandas" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>

                                    </div>

                                </form>
                                 
                                
                                <!-- Marcação -->
                                
                                

                            </div>
                            
                            
                            
                            
                            

                        </div>


                        <div class="tab-pane fade" id="tab2">
                            

                            <!-- Inicio -->
                                    
 
                            
                            <div class="accordion-group widget-box">



                                        <?php
                                        $this->db->select('id, descricao');
                                        $this->db->from('grupos');
                                        $this->db->where('idusumestre', $this->session->userdata('idusumestre'));
                                        $grupos = $this->db->get();

                                        foreach ($grupos->result() as $gru) {
                                            ?>
                                            <div class="accordion-heading">
                                                <div class="widget-title">
                                                    <a data-parent="#collapse-group" href="#collapseG<?php echo $gru->id ?>" data-toggle="collapse">
                                                        <span class="icon"><i class="icon-list"></i></span><h5> <?php echo $gru->descricao ?> </h5>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="collapse accordion-body" id="collapseG<?php echo $gru->id ?>">
                                                <div class="widget-content">
                                                    <table class="table table-bordered">  <tbody>

                                                            <?php
                                                            $this->db->select('idgrupo, idProdutos, descricao, unidade, precoVenda');
                                                            $this->db->from('produtos');
                                                            $this->db->where('idgrupo', $gru->id);
                                                            $this->db->order_by('descricao', 'ASC');
                                                            $produtosEstoque = $this->db->get();

                                                            foreach ($produtosEstoque->result() as $prod) {
                                                                ?>



                                                                <tr>
                                                                    <td style="text-align: left; width: 60%"> <strong> <?php echo $prod->descricao ?> </strong> </td>
                                                                    <td style="text-align: Right; width: 20%"> <strong> <?php echo number_format($prod->precoVenda, 2, ',', '.') ?> </strong> </td>
                                                                    <td style="text-align: left; width: 10%"> <strong> <?php echo $prod->unidade ?></strong></td>                                                     
                                                                    <td style="text-align: left; width: 10%">                
                                                                        <a href="#modalLancar" style="margin-right: 1%" data-toggle="modal" role="button" descricaoProduto= "<?php echo $prod->descricao ?>"  idProduto="<?php echo $prod->idProdutos ?>"   class="btn btn-info tip-top incluiDados" title="Lançar Produto"><i class="icon-share-alt icon-white"></i></a> 
                                                                        <!--<a href="#"     class="btn btn-danger" role="button">Canc</a>-->
                                                                    </td>                                                                    
                                                                </tr>





                                                                <!--
                                                                <div class="row-fluid">                                                           
                                                                    
                                                                <div class="span8">
                                                                     <input class="span8" type="text" disabled="disabled" value="<?php //echo $prod->descricao      ?>"/>  
                                                                     <input class="span2" type="text" disabled="disabled" value="<?php //echo $prod->precoVenda      ?>"/>  
                                                                     <input class="span2" type="text" disabled="disabled" value="<?php //echo $prod->unidade      ?>"/>                                                     
                                                                </div>    
                                                                    
                                                              
                                                                <div class="span4">
                                                                        <a href="#" class="btn btn-success" role="button"><i class="icon-arrow-right icon-white"></i>Pedir</a> 
                                                                    <a href="#modalLancar" style="margin-right: 1%" data-toggle="modal" role="button" descricaoProduto= "<?php //echo $prod->descricao       ?>"  idProduto="<?php //echo $prod->idProdutos       ?>"   class="btn btn-info tip-top incluiDados" title="Lançar Produto"><i class="icon-pencil icon-white"></i></a> 
                                                                      <a href="#" class="btn btn-danger" role="button">Cancelar</a>
                                                                      
                                                                </div>    
                                                                   
                                                              </div>
                                                                -->  

                                                            <?php } ?>    


                                                        </tbody></table>
                                                </div>
                                            </div>
                                        <?php } ?>  

                                    </div>                           
                            
                          
                             
                            
                            
                            
                            
                            
                            
                            <!--Fim-->


                        </div>


                        <div class="tab-pane fade" id="tab3">
                           

                            <!-- Adicionar produtos-->
                                
                                <div class="span12 well" style="padding: 1%; margin-left: 0">

                                    <form id="formProdutos" action="<?php echo base_url(); ?>index.php/comandas/adicionarProduto" method="post">

                                        <div class="span5">
                                            <input type="hidden" name="idProduto" id="idProduto" />
                                            <input type="hidden" name="idVendasProduto" id="idVendasProduto" value="<?php echo $result->idVendas ?>" />
                                            <input type="hidden" name="estoque" id="estoque" value=""/>
                                            <input type="hidden" name="precoref" id="precoref" value=""/>
                                            <!--<input type="hidden" name="preco" id="preco" value=""/> -->

                                            <label for="">Produto</label>
                                            <input type="text" class="span12" name="produto" id="produto" placeholder="Digite o nome do produto" />

                                        </div>

                                        <div class="span2">
                                            <label for="">Quantidade</label>
                                            <input type="tel" class="span12 number" placeholder="0" id="quantidade" name="quantidade"  onblur="aoSairDoCampoQtde(this.value);"  />
                                        </div>

                                        <div class="span1">
                                            <label for="">Un.</label>
                                            <input type="text" class="span12" placeholder="Un." id="unidade" name="unidade"   />
                                        </div>    

                                        <div class="span2">
                                            <label for="preco">Preço</label>
                                            <input type="tel"  class="span12" placeholder="0,00" id="preco" name="preco" onblur="aoSairDoCampoPreco(this.value);" onfocus ="aoEntrarNoCampoPreco(precoref.value)" />           
                                        </div>



                                        <!--

                                        
                                        <div class="span1"> 
                                            <label for="check">Confirma Lançto?</label>
                                                <input  class="span12" type=checkbox id="check" name="check" id="check" /> 
                                        </div>                                            
                                        
                                        

                                        <div class="span2">
                                        </div>
                                       
                                        <div class="span2">
                                             
                                        </div>
                                        
                                        
                                        
                                        --> 

                                        <div class="span2">
                                            <label for="">&nbsp</label>
                                            <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>

                                        </div>



                                    </form>
                                </div>
                                <div class="span12" id="divProdutos" style="margin-left: 0">
                                    <table class="table table-bordered" id="tblProdutos">
                                        <thead>
                                            <tr>
                                                <th>Produto</th>
                                                <th>Quantidade</th>
                                                <th>Unidade</th>
                                                <th>Vlr Unitário</th>
                                                <th>Ações</th>
                                                <th>Sub-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($produtos as $p) {

                                                $total = $total + $p->subTotal;
                                                echo '<tr>';
                                                echo '<td>' . $p->descricao . '</td>';

                                                //Alterações posteriores:
                                                //  1) Exibir Campos: vlr unitário, unidade     
                                                //  2) Configuração por usuário na quantidade de casas decimais tanto da quantidade quanto para o preço unitários e subtotal
                                                echo '<td>' . round($p->quantidade, 0) . '</td>';

                                                echo '<td>' . $p->unidade . '</td>';
                                                echo '<td>R$ ' . number_format($p->vlrunitario, 2, ',', '.') . '</td>';

                                                echo '<td><a href="" idAcao="' . $p->idItens . '" prodAcao="' . $p->idProdutos . '" quantAcao="' . $p->quantidade . '" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
                                                echo '<td>R$ ' . number_format($p->subTotal, 2, ',', '.') . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="5" style="text-align: right"><strong>Total:</strong></td>
                                                <td><strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong> <input type="hidden" id="total-venda" value="<?php echo number_format($total, 2); ?>"></td>
                                            </tr>
                                        </tbody>
                                    </table>





                                </div>
                                
                                <!-- Fim adicionar produto -->


                        </div>



                    </div>




                </div>




            </div>

        </div>
    </div>
</div>


<!-- Modal lançar comanda -->
<div id="modalLancar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formLancar" action="<?php echo base_url() ?>index.php/comandas/adicionar" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">MapOS - Lançar pedido</h3>
        </div>
        <div class="modal-body">
            <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
            <div class="span9" style="margin-left: 0"> 
                <label for="descricao">Descrição</label>
                <input class="span12" id="edtdescricaoProduto" type="text" name="edtdescricaoProduto"  disabled="disabled" />

            </div>  

            <div class="span3" style="margin-left: 5" >
                <label for="edtqtdeProduto">Quantidade</label> 
                <input class="span12" id="edtqtdeProduto" type="number" name="edtqtdeProduto" />
            </div>


        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelarEditar">Cancelar</button>
            <button class="btn btn-success">Lançar Produto</button>
        </div>
    </form>
</div>












<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formFaturar" action="<?php echo current_url() ?>" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Faturar Venda</h3>
        </div>
        <div class="modal-body">

            <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
            <div class="span12" style="margin-left: 0"> 
                <label for="descricao">Descrição</label>
                <input class="span12" id="descricao" type="text" name="descricao" value="Fatura de Venda - #<?php echo $nvenda; ?> "  />

            </div>  
            <div class="span12" style="margin-left: 0"> 
                <div class="span12" style="margin-left: 0"> 
                    <label for="cliente">Cliente*</label>
                    <input class="span12" id="cliente" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
                    <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
                    <input type="hidden" name="vendas_id" id="vendas_id" value="<?php echo $result->idVendas; ?>">
                </div>


            </div>
            <div class="span12" style="margin-left: 0"> 
                <div class="span4" style="margin-left: 0">  
                    <label for="valor">Valor*</label>
                    <input type="hidden" id="tipo" name="tipo" value="receita" /> 
                    <input class="span12 money" id="valor" type="text" name="valor" value="<?php echo number_format($total, 2); ?> "  />
                </div>
                <div class="span4" >
                    <label for="vencimento">Data Vencimento*</label>
                    <input class="span12 datepicker" id="vencimento" type="text" name="vencimento"  />
                </div>

            </div>

            <div class="span12" style="margin-left: 0"> 
                <div class="span4" style="margin-left: 0">
                    <label for="recebido">Recebido?</label>
                    &nbsp &nbsp &nbsp &nbsp<input  id="recebido" type="checkbox" name="recebido" value="1" /> 
                </div>
                <div id="divRecebimento" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="recebimento">Data Recebimento</label>
                        <input class="span12 datepicker" id="recebimento" type="text" name="recebimento" /> 
                    </div>
                    <div class="span6">
                        <label for="formaPgto">Forma Pgto</label>
                        <select name="formaPgto" id="formaPgto" class="span12">
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Cartão de Crédito">Cartão de Crédito</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Boleto">Boleto</option>
                            <option value="Depósito">Depósito</option>
                            <option value="Débito">Débito</option>        
                        </select>
                    </div>
                </div>

            </div>


        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">Cancelar</button>
            <button class="btn btn-primary">Faturar</button>
        </div>
    </form>
</div>


<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>js/maskmoney.js"></script>
<script type="text/javascript">
                                                $(document).ready(function () {

                                                    $(".money").maskMoney({decimal: ",", thousands: ""});

                                                    $('#recebido').click(function (event) {
                                                        var flag = $(this).is(':checked');
                                                        if (flag == true) {
                                                            $('#divRecebimento').show();
                                                        } else {
                                                            $('#divRecebimento').hide();
                                                        }
                                                    });

                                                    $(document).on('click', '#btn-faturar', function (event) {
                                                        event.preventDefault();
                                                        valor = $('#total-venda').val();
                                                        valor = valor.replace(',', '');
                                                        $('#valor').val(valor);
                                                    });

                                                    $("#formFaturar").validate({
                                                        rules: {
                                                            descricao: {required: true},
                                                            cliente: {required: true},
                                                            valor: {required: true},
                                                            vencimento: {required: true}

                                                        },
                                                        messages: {
                                                            descricao: {required: 'Campo Requerido.'},
                                                            cliente: {required: 'Campo Requerido.'},
                                                            valor: {required: 'Campo Requerido.'},
                                                            vencimento: {required: 'Campo Requerido.'}
                                                        },
                                                        submitHandler: function (form) {
                                                            var dados = $(form).serialize();
                                                            $('#btn-cancelar-faturar').trigger('click');
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "<?php echo base_url(); ?>index.php/comandas/faturar",
                                                                data: dados,
                                                                dataType: 'json',
                                                                success: function (data)
                                                                {
                                                                    if (data.result == true) {

                                                                        window.location.reload(true);
                                                                    } else {
                                                                        alert('Ocorreu um erro ao tentar faturar venda.');
                                                                        $('#progress-fatura').hide();
                                                                    }
                                                                }
                                                            });

                                                            return false;
                                                        }
                                                    });

                                                    $("#produto").autocomplete({
                                                        source: "<?php echo base_url(); ?>index.php/os/autoCompleteProduto",
                                                        minLength: 2,
                                                        select: function (event, ui) {

                                                            $("#idProduto").val(ui.item.id);
                                                            $("#estoque").val(ui.item.estoque);
                                                            $("#precoref").val(ui.item.preco);
                                                            $("#unidade").val(ui.item.unidade);

                                                            if ($("#idProduto").length > 0) {

                                                                var str = ui.item.preco;
                                                                var res = str.replace('.', ',');

                                                                document.getElementById('preco').setAttribute('placeholder', res);
                                                            }

                                                            $("#quantidade").focus();

                                                        }
                                                    });



                                                    $("#cliente").autocomplete({
                                                        source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
                                                        minLength: 2,
                                                        select: function (event, ui) {

                                                            $("#clientes_id").val(ui.item.id);


                                                        }
                                                    });

                                                    $("#tecnico").autocomplete({
                                                        source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
                                                        minLength: 2,
                                                        select: function (event, ui) {

                                                            $("#usuarios_id").val(ui.item.id);


                                                        }
                                                    });



                                                    $("#formVendas").validate({
                                                        rules: {
                                                            cliente: {required: true},
                                                            tecnico: {required: true},
                                                            dataVenda: {required: true}
                                                        },
                                                        messages: {
                                                            cliente: {required: 'Campo Requerido.'},
                                                            tecnico: {required: 'Campo Requerido.'},
                                                            dataVenda: {required: 'Campo Requerido.'}
                                                        },
                                                        errorClass: "help-inline",
                                                        errorElement: "span",
                                                        highlight: function (element, errorClass, validClass) {
                                                            $(element).parents('.control-group').addClass('error');
                                                        },
                                                        unhighlight: function (element, errorClass, validClass) {
                                                            $(element).parents('.control-group').removeClass('error');
                                                            $(element).parents('.control-group').addClass('success');
                                                        }
                                                    });




                                                    $("#formProdutos").validate({
                                                        rules: {
                                                            quantidade: {required: true},
                                                            preco: {required: true}
                                                        },
                                                        messages: {
                                                            quantidade: {required: 'Insira a quantidade'},
                                                            preco: {required: 'Insira o preço'}
                                                        },
                                                        submitHandler: function (form) {
                                                            var quantidade = parseInt($("#quantidade").val());
                                                            var estoque = parseInt($("#estoque").val());
                                                            if (estoque < quantidade) {
                                                                alert('Você não possui estoque suficiente.');
                                                            } else {
                                                                var dados = $(form).serialize();
                                                                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "<?php echo base_url(); ?>index.php/comandas/adicionarProduto",
                                                                    data: dados,
                                                                    dataType: 'json',
                                                                    success: function (data)
                                                                    {
                                                                        if (data.result == true) {
                                                                            $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                                                                            $("#quantidade").val('');
                                                                            $("#preco").val('');
                                                                            $("#unidade").val('');
                                                                            $("#precoref").val('');

                                                                            document.getElementById('preco').setAttribute('placeholder', '0,00');

                                                                            $("#produto").val('').focus();
                                                                        } else {
                                                                            alert('Ocorreu um erro ao tentar adicionar produto.');
                                                                        }
                                                                    }
                                                                });

                                                                return false;
                                                            }

                                                        }

                                                    });



                                                    $(document).on('click', 'a', function (event) {
                                                        var idProduto = $(this).attr('idAcao');
                                                        var quantidade = $(this).attr('quantAcao');
                                                        var produto = $(this).attr('prodAcao');
                                                        if ((idProduto % 1) == 0) {
                                                            $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "<?php echo base_url(); ?>index.php/comandas/excluirProduto",
                                                                data: "idProduto=" + idProduto + "&quantidade=" + quantidade + "&produto=" + produto,
                                                                dataType: 'json',
                                                                success: function (data)
                                                                {
                                                                    if (data.result == true) {
                                                                        $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");

                                                                    } else {
                                                                        alert('Ocorreu um erro ao tentar excluir produto.');
                                                                    }
                                                                }
                                                            });
                                                            return false;
                                                        }

                                                    });

                                                    $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});



$(document).on('click', '.incluiDados', function (event) {
            $("#edtdescricaoProduto").val($(this).attr('descricaoProduto'));


        });


        $('#departamento').change(function () {
            $("#mensagem").html("<p>Aguarde...</p> ");
            $('#atender').load('<?php echo base_url(); ?>index.php/comandas/atender?term=' + $('#departamento').val());
            $("#mensagem").html("<p></p> ");
        });







                                                });

</script>


<script type="text/javascript">

    function validarDados() {
        var iDepartamento = $('#departamento').val();
        var iAtender = $('#atender').val();
        var sclientes_id = $('#clientes_id').val();



        if (iDepartamento == -1) {

            alert("Preencha o campo Local de Atendimento");
            $('#departamento').focus();

            return false;

        }

        if (iAtender == -1) {

            alert("Preencha o campo Ponto de Atendimento");
            $('#atender').focus();

            return false;

        }

        if (sclientes_id === "") {

            alert("Preencha o campo cliente");
            $('#clientes_id').focus();

            return false;



        }



    }
</script>    
