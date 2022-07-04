<?php
	$this->load->view("layouts/header");
?>
        <div  class="container">

                <div class="row mt-5">
                  <div class="col-10"><h5>HISTÓRICO DE MÁQUINAS</h5></div>
                  <div class="col-2"><a style="text-decoration: none; color: black;" href="<?php echo base_url(); ?>"><- Voltar ao Início</a></div>
                </div>
                <hr class="mt-2 mb-5"/>

      <div class="row">
  <div class="col-md-12">
    <div class="table-responsive">


      <table style="padding-top: 10px;" class="table hover order-column stripe cell-border" id="table">
        <thead>
          <tr style="background: #e56b11; color: white;">
            <th class="text-center">ID</th>
            <th class="text-center">Unidade</th>
            <th class="text-center">Num Série</th>
            <th class="text-center">Rg do Responsável</th>
            <th class="text-center">Data da Entrega</th>
            <th class="text-center">Observação</th>
            <th class="text-center">Rg do Usuário</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
</div >

<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
 
 
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Maquinas/ajax_list')?>",
            "type": "POST",
            "dataSrc": function (data) {

                return data.data;


            },  
            "error": function (e) {

            }
            },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
        "language": {
        "sInfo": "_START_ - _END_ /_TOTAL_",
          //"sProcessing":   "Processando...",
          "sProcessing":   "",
          "sLengthMenu":   "Mostrar _MENU_ registros",
          "sZeroRecords":  "Não foram encontrados resultados",
          "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
          "sInfoFiltered": "",
          "sInfoPostFix":  "",
          "sSearch":       "Buscar:",
          "sInfoFiltered" : "",
          "paginate": {
            "last": ">>",
            "first": "<<",
            "next": ">",
            "previous": "<"
          }
        },
 
    });
 
});
</script>
        
<?php
	$this->load->view("layouts/footer");
?>


