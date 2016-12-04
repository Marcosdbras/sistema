<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Xml{
    //atributos
    private $dom;
    private $tab = 1;
    private $response;
    private $root;

    //Métodos
    public function __construct($version='1.0', $encoding='UTF-8',$type='webservicecep'){
       
       
        #versao do encoding xml
        $this->dom = new DOMDocument( '"'.$version.'"', '"'.$encoding.'"');
        
        #retirar os espacos em branco
        $this->dom->preserveWhiteSpace = false;
       
        #gerar o codigo
        $this->dom->formatOutput = true;

        #criando o nó principal (root)
        $this->root = $this->dom->createElement("$type");
        
        #nó filho (contato=response)
        $this->response = $this->dom->createElement("response");  
        
        /*$this->xml = '<?xml version="'.$version.'" encoding="'.$encoding.'" ?>';*/
       
        echo 'construido';
    }
    
    public function openTag($name){
        

       //$this->addTab();
        //$this->xml .= "<$name>\n";
        //$this->tab++;
        
        
    }
    
    
    
    public function closedoc(){
        
       #cabeçalho da página
       return header("Content-Type: text/xml");  
        
    }
    
    
    public function closeTag($name){
        
        //$this->tab--;
        //$this->addTab();
        //$this->xml .= "</$name>\n"; 
        
    }
    
    public function setValue($value){
      
        //$this->xml .= "$value\n"; 
       
    }
    
    private function addTab(){
        //for ($i = 1;$i <= $this->tab;$i++){
            //$this->xml .= "\t";
        //}
    }
    
    public function addTag($name, $value){
    
       #setanto nomes e atributos dos elementos xml (nós)
       $retorno = $this->dom->createElement("$name", "$value");
 
       #adiciona os nós (informacaoes)
       $add->appendChild($retorno);

       #adiciona o nó contato em (root)
       $this->root->appendChild($add);

       $this->dom->appendChild($this->root);

        

        //$this->addTab();   
        //$this->xml .= "<$name>$value</$name>";
        
        
    }
    
    public function __toString() {
       
       # imprime o xml na tela
 
       echo $this->dom->saveXML();
        
        return $this->dom->saveXML();        
 
       //if (trim($this->xml) != '<></>')
       //   return trim($this->xml);
           
    }
}