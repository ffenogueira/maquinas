<?php
  $this->load->view("layouts/header");
?>
<style type="text/css">
  body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;

}
.botao{
  margin-top: 5px;
  margin-bottom: 5px;
}
.img{
 margin-top: 50px;
}
.titulo{
  margin-bottom: 50px;
}

</style>


<main class="form-signin">
  <form>
    <img class="img" src="<?php echo base_url('assets/image/logo_assinfo.png')?>" alt="Assesoria de Informática da SEDEC" >
    
    <h3 class="titulo">Controle de Máquinas</h3>

    <div class="botao">
      <a href="<?php echo base_url('index.php/Maquinas/entrada')?>" class="w-100 btn btn-lg btn-outline-primary" type="button">Entrada de Máquina</a>
    </div>
    <div class="botao">
      <a href="<?php echo base_url('index.php/Maquinas/saida')?>" class="w-100 btn btn-lg btn-outline-danger" type="button">Saída de Máquina</a>
    </div>
    <div class="botao">
      <a href="<?php echo base_url('index.php/Maquinas/listarEntrada')?>" class="w-100 btn btn-lg btn-outline-secondary" type="button">Histórico </a>
    </div>

    
  </form>
</main>