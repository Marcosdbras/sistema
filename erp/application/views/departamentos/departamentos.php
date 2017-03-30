<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aDepartamento')){ ?>
    <a href="<?php echo base_url();?>index.php/departamentos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Departamento</a>
<?php } ?>

<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Departamentos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Descrição</th>
            <th></th>
            <th>Id</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="5">Nenhum Departamento Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>

<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Departamentos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            
            <th>Descrição</th>
            <th></th>
            <th>Id</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->iddetalhe.'</td>';
            
            echo '<td>'.$r->descricao.'</td>';
            
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vDepartamento')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/departamentos/visualizar/'.$r->id.'" class="btn tip-top" title="Visualizar Departamento"><i class="icon-eye-open"></i></a>  '; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eDepartamento')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/departamentos/editar/'.$r->id.'" class="btn btn-info tip-top" title="Editar Departamento"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dDepartamento')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" departamento="'.$r->id.'" class="btn btn-danger tip-top" title="Excluir Departamento"><i class="icon-remove icon-white"></i></a>'; 
            }
                     
            
            echo '</td>';
            
            echo '<td>'.$r->id.'</td>';
            
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
	
<?php echo $this->pagination->create_links();}?>



<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/departamentos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Departamento</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idDepartamento" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este departamento?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>



<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var departamento = $(this).attr('departamento');
        $('#idDepartamento').val(departamento);

    });

});

</script>