<?php
	$this->load->view("layouts/header");
?>
 <div class="container">
        <div >
            <form method="post" action="" actomp class="row mt-5 mb-5">

            <?php 
                if($this->session->flashdata('message')){

                $message = $this->session->flashdata('message');
            ?>
            <div class="alert alert-<?php echo   $message["type"]; ?>" role="alert">
                <?php echo $message["message"] ?>
            </div>
            <?php
                }
            ?>
                  <div class="row mt-5">
                  <div class="col-10"><h5>DADOS DE ENTRADA DE MÁQUINA</h5></div>
                  <div class="col-2"><a style="text-decoration: none; color: black;" href="<?php echo base_url(); ?>"><- Voltar ao Início</a></div>
                  </div>
                <hr class="mt-2 mb-5"/>

				<div class="col-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Unidade</label>
                            <select class="form-select" name="unidade" aria-label="unidade-label">
                                <?php foreach($unidades as $key => $unidade)
                                    {
                                        echo '<option value="'.$unidade->codigo_unidade.'">'.$unidade->unidade.'</option>';
                                    } 
                                ?>                        
                            </select>
                        </div>
                    </div>
                <!--
				<div class="col-2">
                    <div class="mb-3">
                        <label for="" class="form-label">Chamado</label>
                        <div class="input-group mb-3">

                            <input type="text" name="chamado" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                                -->

                <div class="col-2">
                    <div class="mb-3">
                        <label for="" class="form-label">Serial Number</label>
                        <div class="input-group mb-3">

                            <input type="text" name="num_serie" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>


                <div class="col-2">
                    <div class="mb-3">
                        <label for="" class="form-label">Responsável RG</label>
                        <div class="input-group mb-3">

                            <input type="text" name="rg_entrega" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="mb-3">
                        <label for="" class="form-label">Data de Entrada</label>
                        <div class="input-group mb-3">

                            <input type="date" name="data_entrada" class="form-control" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">                            
                        <label for="" class="form-label">Observação de Entrada</label>
                        <div class="form-floating">
                            <textarea name="observacao"  class="form-control" style="height:200px"  placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea"></label>
                        </div>
                </div>
   
      
                <div class="d-grid gap-2 col-6 mx-auto mb-5">
                    <button class="btn btn-lg btn-primary" type="submit">CONFIRMAR</button>
                </div>

                
                    


            </form>
        </div>
    </div>




<?php
	$this->load->view("layouts/footer");
?>