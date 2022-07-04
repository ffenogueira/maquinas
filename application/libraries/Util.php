<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class util {


    private function getSoapClient(){
        

        $location = 'http://desenvolvimento.cbmerj.rj.gov.br/dbu/server.php';
        $uri = 'http://desenvolvimento.cbmerj.rj.gov.br/dbu';

        $cliente = new SoapClient(null, array(
            'location' => $location,
            'uri' => $uri));
            return $cliente;
    }


    //para uso interno(controller)
    public function buscarMilitarController($rg) {

        $cliente = $this->getSoapClient();

        $militar = json_decode($cliente->militar($rg));

        return $militar;
    }

    public function buscar_consultas($rg) {

        $cliente = $this->getSoapClient();

        $consultas = json_decode($cliente->busca($rg));

        return $consultas;
    }

    public function dependentes($rg) {

        $cliente = $this->getSoapClient();


        $dependentes = json_decode($cliente->militar_dependentes($rg));

        return $dependentes;
    }

    public function buscar_foto_militar($rg) {

// 		$cliente = new SoapClient(null, array(
// 				'location' => "http://ws2.cbmerj.rj.gov.br/server.php",
// 				'uri' => "http://ws2.cbmerj.rj.gov.br/",
// 				'trace' => 1));
// 		$militar = json_decode($cliente->militar($rg));
// 		return $militar;

        return NULL;
    }

    public function militar($rg) {

        $cliente = $this->getSoapClient();
        $militar = json_decode($cliente->militar($rg));
        return $militar;
    }

    public function trocaSenha($rg, $senha){

        $cliente = $this->getSoapClient();
        $cliente->trocaSenha(sprintf('%s', (int)$rg), $senha);

        return true;
    }


    public function unidades($codigo_unidade = null) {

        $cliente = $this->getSoapClient();


        $unidade = json_decode($cliente->unidades(NULL, NULL, $codigo_unidade));

        return $unidade;
    }

    public function graduacao($rg) {

        $cliente = $this->getSoapClient();


        $graduacao = json_decode($cliente->graduacoes($rg));

        return $graduacao;
    }

    public function recupera_dominio() {
        //VERIFICAR DOMINIO PARA ACESSAR O COOKIE: VERIFICAR SE FUNCIONA COM SUBDOMINIO
        return (string) $_SERVER['SERVER_NAME'];
//     	return (string) 'cbmerj.rj.gov.br';
    }

    public function valida_token() {

// 	    $pass = "1234";
// 		echo crypt($pass, 'cbmerj');
//     	$hashed_password = crypt('mypassword');
//     	if (crypt('mypassword123', $hashed_password) == $hashed_password) {
//     		echo "Password verified!";
//     	}else{
//     		echo 'Password is not valid';
//     	}
// 		exit;
//     	$hash = $this->recupera_token();
//     	//inicio ws
//     	$conn_string = "host=10.40.8.24 port=5432 dbname=intranet_acesso user=postgres password=postgres";
//     	$dbconn = pg_connect($conn_string);
//     	$result = pg_query($dbconn, "SELECT * FROM tb_acesso WHERE acesso_sigla = 'INT'");
//     	while ($row = pg_fetch_row($result)){
//     		$senha = $row[1];
//     	}
//     	if (Bcrypt::check($senha, $hash)) {
//     		echo 'Senha OK!';
//     	} else {
//     		exit('Senha incorreta!');
//     	}

        return '1234';
    }

    public function recupera_token() {

//     	$cliente = new SoapClient(null, array(
// 		    			'location' => "http://ws2.cbmerj.rj.gov.br/server.php",
// 		    			'uri' => "http://ws2.cbmerj.rj.gov.br/",
// 		    			'trace' => 1));
//     	$chave = json_decode($cliente->obter_chave('INT'));
        //inicio WS
        $conn_string = "host=10.40.8.24 port=5432 dbname=intranet_acesso user=postgres password=postgres";
        $dbconn = pg_connect($conn_string);

        $result = pg_query($dbconn, "SELECT * FROM tb_acesso WHERE acesso_sigla = 'INT'");

        $ci = & get_instance();
        $ci->load->library('Bcrypt');

        while ($row = pg_fetch_row($result)) {

            $senha = $row[1];
            $hash = Bcrypt::hash($senha);
        }

        return $hash;

        //FIM WS
    }

    //Busca o militar ou pensionista pelo RG(tipos 1 e 3 somente)
    public function getUserByRg($rg) {

        $cliente = $this->getSoapClient();

        $busca = json_decode($cliente->busca($rg));
        $userData = array();


        //echo '<pre>'; print_r($busca); echo '</pre>';
        //var_dump($busca);

        if(!is_null($busca)){

            foreach ($busca as $key  => $val) {

                if($val->tipo == 1 || $val->tipo == 3 || $val->tipo == 7 || $val->tipo == 9){

                    $userData = $val;
                    return $userData;

                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    public function temAd($rg)
    {
        $cliente = $this->getSoapClient();
        return $cliente->temAd(sprintf('%s', (int)$rg));
    }

    //Cria um novo registro no AD para pensionistas
    public function adicionarUsuario($rg, $nome, $senha, $tipo) {

        $cliente = $this->getSoapClient();
        
        $cliente->adicionarUsuario($rg, $nome, $senha, $tipo);

    }

    /*
     * Método utilizado na página de lock screen
     */

    public function sessao_lock_screen() {

        if ($this->session->userdata('nome_guerra')) {

            $this->session->set_userdata('unlock_nome_guerra', $this->session->userdata('nome_guerra'));
        } else {

            redirect('login/desbloquear');
        }
    }

    public function checkPassword($pwd) {

        $retorno = array(
            'erro' => 0,
            'arrayErros' => array()
        );

        if( strlen( trim($pwd) ) > 0 ){

            if (!preg_match("/^[a-zA-Z\d]+$/", $pwd) == TRUE) {
                $retorno['erro'] = 1;
                $retorno['arrayErros'][count($retorno['arrayErros'])] = 'A senha n�o deve conter caracteres especiais.';
            }

            if (strlen($pwd) < 7) {
                $retorno['erro'] = 1;
                $retorno['arrayErros'][count($retorno['arrayErros'])] = 'A senha deve conter ao menos 7 caracteres.';
            }

            if (!preg_match("#[0-9]+#", $pwd)) {
                $retorno['erro'] = 1;
                $retorno['arrayErros'][count($retorno['arrayErros'])] = 'A senha deve conter ao menos 1 número.';
            }

            if (!preg_match("#[a-zA-Z]+#", $pwd)) {
                $retorno['erro'] = 1;
                $retorno['arrayErros'][count($retorno['arrayErros'])] = 'A senha deve conter ao menos 1 letra.';
            }
        } else {
            $retorno['erro'] = 1;
            $retorno['arrayErros'][count($retorno['arrayErros'])] = 'A senha deve preenchida.';
        }

        return $retorno;

    }

}
