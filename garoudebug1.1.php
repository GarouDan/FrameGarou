<?php
/**
Autor: Danilo Ara�jo Silva
�ltima atualiza��o: 01-10-2012
Descri��o: classe para auxiliar na inspe��o, corre��o e debuga��o de c�digos na linguagem PHP.
 T�m o objetivo de ser independente do sistema, funcionando apenas com a inclus�o deste arquivo.
*/

/*

//C�digo para inclus�o no arquivo a ser debugado:
//------------------------------------------------------------
if(file_exists('garoudebug.php')){
  include('garoudebug.php');
}else{
  echo '<br>GarouDebug n�o encontrado.<br>';
  exit;
}
//------------------------------------------------------------
//Opcional:
garou();

*/

function d($texto=null){
//Alias para a fun��o imprimeTextoLegivel.
    $backtrace = debug_backtrace();
    $chamada = array_shift($backtrace);
    
    $linha = $chamada['line'];
    $arquivo = $chamada['file'];
    imprimeTextoLegivel($texto,$linha,$arquivo);
}

function dp($texto=null){
//Alias para a fun��o imprimeTextoLegivel mas para a execu��o.
    $backtrace = debug_backtrace();
    $chamada = array_shift($backtrace);
    
    $linha = $chamada['line'];
    $arquivo = $chamada['file'];
    imprimeTextoLegivel($texto,$linha,$arquivo);
    exit;
}

function g(){
//Alias para a fun��o mostrarGET.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarGET($linha,$arquivo);
}

function garou(){
//Confirma se o debugador foi inclu�do corretamente.
    $mensagem='GarouDebug est� funcionando corretamente.';
    imprimeVariavelLegivel($mensagem);
    exit;
}

function gp(){
//Alias para a fun��o mostrarGETEPara.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarGETEPara($linha,$arquivo);
}

function imprimeTextoLegivel($texto=null,$linha=null,$arquivo=null){
//Imprime um texto de forma leg�vel. Se n�o houver texto imprive uma
//  mensagem padronizada.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }
    
    $cabecalho  = "\n";
    $cabecalho .= "<br>";
    $cabecalho .= "Linha: ";
    $cabecalho .= $linha;
    $cabecalho .= "\n";
    $cabecalho .= "<br>";
    $cabecalho .= "Arquivo: ";
    $cabecalho .= $arquivo;
    
    echo $cabecalho;
    
    
    $retorno  = "\n";
    $retorno .= "<br>";
    
    if(isset($texto)){
        $retorno .= $texto;
    }elseif($texto===null){
        $retorno .= 'GarouDebug';
    }
    
    $retorno .= "<br>";
    $retorno .= "\n";
    
    echo $retorno;
}

function imprimeVariavelLegivel($variavel){
//Imprime o conte�do de uma vari�vel de forma leg�vel.
    $retorno  = "\n";
    $retorno .= "<br>";
    $retorno .= "<pre>";
    
    $retorno .= $variavel;
    
    $retorno .= "</pre>";
    $retorno .= "<br>";
    $retorno .= "\n";
    
    echo $retorno;
}

function imprimeVetorLegivel($vetor){
//Imprime o conte�do de um vetor de forma leg�vel.
    $retorno  = "\n";
    $retorno .= "<br>";
    $retorno .= "<pre>";
    echo $retorno;
    
    print_r($vetor);
    
    $retorno  = "\n";
    $retorno .= "</pre>";
    $retorno .= "<br>";
    echo $retorno;
}

function l(&$parametro=null){
//Alias para a fun��o legivel.
    $backtrace = debug_backtrace();
    $chamada = array_shift($backtrace);
    
    $linha = $chamada['line'];
    $arquivo = $chamada['file'];
    
    legivel($parametro,$linha,$arquivo);
}

function legivel(&$parametro=null,$linha=null,$arquivo=null){
//N�o completamente implementada ainda. 
//Se n�o passado nenhum par�metro, imprime o nome do arquivo vigente e o n�mero
//  da linha corrente de forma leg�vel.
// 
//Se passado o nome de uma vari�vel (podendo ser um vetor), imprime o nome do
//  arquivo vigente, o n�mero da linha, o nome da vari�vel e o seu conte�do de
//  leg�veis.
    
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }
    
    $cabecalho  = "\n";
    $cabecalho .= "<br>";
    $cabecalho .= "Linha: ";
    $cabecalho .= $linha;
    $cabecalho .= "\n";
    $cabecalho .= "<br>";
    $cabecalho .= "Arquivo: ";
    $cabecalho .= $arquivo;
    
    echo $cabecalho;
    
    if(isset($parametro)){
      $nomeVariavel=nomeVariavel($parametro);
      
      $cabecalho  = "\n";
      $cabecalho .= "<br>";
      $cabecalho .= $nomeVariavel;
      $cabecalho .= ":";
      $cabecalho .= "<br>";
      $cabecalho .= "\n";
      
      echo $cabecalho;
      
      if(is_array($parametro)){
          imprimeVetorLegivel($parametro);
      }else{
          imprimeVariavelLegivel($parametro);
      }
    }
}

function legivelEPara(&$parametro=null,$linha=null,$arquivo=null){
//N�o completamente implementada ainda. 
//Se n�o passado nenhum par�metro, imprime o nome do arquivo vigente e o n�mero
//  da linha corrente de forma leg�vel. Para a execu��o neste ponto.
// 
//Se passado o nome de uma vari�vel (podendo ser um vetor), imprime o nome do
//  arquivo vigente, o n�mero da linha, o nome da vari�vel e o seu conte�do de
//  leg�veis. Para a execu��o neste ponto.
    legivel($parametro,$linha,$arquivo);
    exit;
    
}

function linhaEArquivo(){
    $backtrace = debug_backtrace();
    $chamada = array_shift($backtrace);
    echo $chamada['line'];
    //l($chamada['line']);
}

function lp(&$parametro=null){
//Alias para a fun��o legivelEPara.

    $backtrace = debug_backtrace();
    $chamada = array_shift($backtrace);
    
    $linha = $chamada['line'];
    $arquivo = $chamada['file'];
    
    legivelEPara($parametro,$linha,$arquivo);
}

function nomeVariavel(&$variavel, $escopo=false, $prefixo='unique', $sufixo='value'){
//Retorna o nome da vari�vel passada.
//Necess�rio entender o c�digo e vert�-lo para o portugu�s e melhorar os nomes.
    if($escopo) $valorores = $escopo;
    else      $valorores = $GLOBALS;
    $antigo = $variavel;
    $variavel = $novo = $prefixo.rand().$sufixo;
    $nomeVariavel = FALSE;
    foreach($valorores as $chave => $valor) {
      if($valor === $novo) $nomeVariavel = $chave;
    }
    $variavel = $antigo;
    return $nomeVariavel;
}

function mostrarGET($linha=null,$arquivo=null){
//Mostra os valores da vari�vel GET.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivel($_GET,$linha,$arquivo);
}

function mostrarGETEPARA($linha=null,$arquivo=null){
//Mostra os valores da vari�vel GET. Para a execu��o.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivelEPara($_GET,$linha,$arquivo);
}

function mostrarPOST($linha=null,$arquivo=null){
//Mostra os valores da vari�vel POST.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivel($_POST,$linha,$arquivo);
}

function mostrarPOSTEPARA($linha=null,$arquivo=null){
//Mostra os valores da vari�vel POST. Para a execu��o.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivelEPara($_POST,$linha,$arquivo);
}

function mostrarREQUEST($linha=null,$arquivo=null){
//Mostra os valores da vari�vel REQUEST.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivel($_REQUEST,$linha,$arquivo);
}

function mostrarREQUESTEPARA($linha=null,$arquivo=null){
//Mostra os valores da vari�vel REQUEST. Para a execu��o.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivelEPara($_REQUEST,$linha,$arquivo);
}

function mostrarSESSION($linha=null,$arquivo=null){
//Mostra os valores das variaveis da sess�o.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivel($_SESSION,$linha,$arquivo);
}

function mostrarSESSIONEPara($linha=null,$arquivo=null){
//Mostra os valores das variaveis da sess�o. Para a execu��o.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    legivelEPara($_SESSION,$linha,$arquivo);
}

function mostraVariaveisEConstantes(){
//Mostra os valores das vari�veis vigentes.
    legivel($GLOBALS);
    legivel(get_defined_constants());
}

function mostraVariaveisEConstantesEPara(){
//Mostra os valores das vari�veis vigentes. Para a execu��o.
    legivel($GLOBALS);
    legivelEPara(get_defined_constants());
}

function p(){
//Alias para a fun��o mostrarPOST.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarPOST($linha,$arquivo);
}

function pp(){
//Alias para a fun��o mostrarPOSTEPara.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarPOSTEPara($linha,$arquivo);
}

function r(){
//Alias para a fun��o mostrarREQUEST.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarREQUEST($linha,$arquivo);
}

function rp(){
//Alias para a fun��o mostrarREQUESTEPara.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarREQUESTEPara($linha,$arquivo);
}

function s(){
//Alias para a fun��o mostrarSESSION.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarSESSION($linha,$arquivo);
}

function sp(){
//Alias para a fun��o mostrarSESSIONEPara.
    if(!isset($linha) or !isset($arquivo)){
        $backtrace = debug_backtrace();
        $chamada = array_shift($backtrace);
        
        $linha = $chamada['line'];
        $arquivo = $chamada['file'];
    }

    mostrarSESSIONEPara($linha,$arquivo);
}

function v(){
//Alias para a fun��o mostraVariaveisEConstantes.
    mostraVariaveisEConstantes();
}

function vp(){
//Alias para a fun��o mostraVariaveisEConstantesEPara.
    mostraVariaveisEConstantesEPara();
}

?>