<?php
require '../erp/setupConstante/configuracao.php';

//--------------------------------------------------
//$this->db->select('idUsuarios, nome, mestre');
//$thit->db->from('usuarios');
//$this->db->where('idUsuarios',$this->session->userdata('id'));
//$this->db->limit(1);
//$this->db->get();
?>


<link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Lançar Pedido</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da venda</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">
                                <?php if ($custom_error == true) { ?>
                                    <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente e responsável.</div>
                                <?php } ?>
                                <form action="<?php echo current_url(); ?>" method="post" onsubmit="return validarDados();"  id="formVendas">




                                    <div class="row-fluid">


                                        <div class="span12" style="padding: 1%">



                                            <div class="span4">
                                                <label for="dataInicial">Data da Venda<span class="required">*</span></label>
                                                <input id="dataVenda" class="span12 datepicker" type="text" name="dataVenda" value="<?php echo $dataLocal ?>"  />
                                            </div>

                                            <div class="span4">
                                                <label for="tecnico">Responsável<span class="required">*</span></label>
                                                <input id="tecnico" class="span12" type="text" name="tecnico" value="<?php echo $this->session->userdata('nome') ?>"  />
                                                <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $this->session->userdata('id') ?>"  />
                                            </div>

                                            <div class="span4">
                                                <label for="cliente">Cliente<span class="required">*</span></label>
                                                <input id="cliente" class="span12" type="text" name="cliente" value=""  />
                                                <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value=""  />
                                            </div>
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
                                <div class="span6 offset3" style="text-align: center">
                                    <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
                                    <a href="<?php echo base_url() ?>index.php/comandas" class="btn"><i class="icon-arrow-left"></i> Voltar</a> 
                                </div>
                            </div>

                            <div id="mensagem">

                            </div> 

                            </form>
                        </div>

                    </div>

                </div>

            </div>




        </div>







    </div>
</div>






<script type="text/javascript">
    $(document).ready(function () {

        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteCliente",
            minLength: 1,
            select: function (event, ui) {

                $("#clientes_id").val(ui.item.id);


            }
        });

        $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteUsuario",
            minLength: 1,
            select: function (event, ui) {

                $("#usuarios_id").val(ui.item.id);


            }
        });




        $("#formVendas").validate({
            rules: {
                cliente: {required: true},
                //departamento: {required: true},
                //atender: {required: true},
                tecnico: {required: true},
                dataVenda: {required: true}
            },
            messages: {
                cliente: {required: 'Campo Requerido.'},
                //departamento: {required: 'Campo Requerido.'},
                //atender: {required: 'Campo Requerido.'},
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

        if (sclientes_id === ""){
            
            alert("Preencha o campo cliente");
            $('#clientes_id').focus();

            return false;
            

        
        } 
        


    }
</script>    


