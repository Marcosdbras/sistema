<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//Deleta Registro
function DBDelete($table,$where=NULL,$linhasaf=false){
    
    if (DB_PREFIX != ''){
      $table = DB_PREFIX . '_' . $table;    
    }
    
    $where = ($where)? " WHERE {$where}":null;
    $query = "DELETE FROM {$table}{$where}";    

    //var_dump($query);
    return DBExecute($query,false,$linhasaf); 
} 
   


/*Alterar Registros*/
function DBUpDate($table, array $data, $where = NULL, $insertId=false, $linhasaf=false){
    foreach($data as $key =>$value){
        $fields[] = "{$key} = '{$value}'";
        
    }
    $fields = implode(', ',$fields);
    
    if (DB_PREFIX != ''){
      $table = DB_PREFIX . '_' . $table;    
    }

    $where = ($where)? " WHERE {$where}":null;
    $query = "UPDATE {$table} SET {$fields}{$where}";   
    
     //echo $query;   
    
     return DBExecute($query, $insertId, $linhasaf);
}


/*Insere registro no banco*/
function DBCreate($table, array $data, $insertId = false) {

    if (DB_PREFIX != ''){
      $table = DB_PREFIX . '_' . $table;    
    }

    $data = DBEscape($data);

    //printf("%s dados.\n", $data);

    $fields = implode(', ', array_keys($data));
    $values = "'" . implode("', '", $data) . "'";


    $query = "INSERT INTO {$table} ({$fields}) VALUES ({$values})";

    
    //echo $query;
    
    return DBExecute($query, $insertId);
}
/*Executa comando no banco*/
function DBExecute($query, $insertId=false, $linhasaf=false) {
    $mysqli = DBConnect();
    $result = $mysqli->query($query);

    if ($mysqli->connect_errno) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        exit();
        
    }


    if ($linhasaf) {

       $result = $mysqli->affected_rows;

    } else {


      if ($insertId){

         $result = $mysqli->insert_id; 
        
      } 


    }

    //printf("%d linha(s) afetada(s).\n", $mysqli->affected_rows);
   
    
    DBClose($mysqli);

    return $result;    
}


/*Limpar registro
segurança SQLInjection */
function DBEscape($dados) {

    $mysqli = DBConnect();

    if (!is_array($dados)) {
        $dados = $mysqli->real_escape_string($dados);
    } else {
        $arr = $dados;
        foreach ($arr as $key => $value) {
            $key = $mysqli->real_escape_string($key);
            $value = $mysqli->real_escape_string($value);
            $dados[$key] = $value;
        }
    }


    DBClose($mysqli);

    return $dados;
}

/*Ler Registros*/
function DBRead($table, $params=null, $fields='*'){

    if (DB_PREFIX != ''){
      $table = DB_PREFIX . '_' . $table;    
    }

    $params =  ($params) ? " {$params}":null;
    $query = "SELECT {$fields} FROM {$table}{$params}";  
    $result = DBExecute($query);
    
    //printf("total de %d registro(s).\n", $result->num_rows);
    //printf("%d total de .\n", $result->fetch_assoc);    
    //printf("SELECT {$fields} FROM {$table}{$params}");

    if (!$result->num_rows){
        return false;
        
    }else{
        while ($res = $result->fetch_assoc()){
            $data[] = $res;
        }
        return $data;
        
    }
    
    $result->close;
    
}



/*Total de Registros*/
function DBTotReg($table, $params=null, $fields='*'){

    if (DB_PREFIX != ''){
      $table = DB_PREFIX . '_' . $table;    
    }

    $params =  ($params) ? " {$params}":null;
    $query = "SELECT {$fields} FROM {$table}{$params}";  
    $result = DBExecute($query);
    
    //printf("total de %d registro(s).\n", $result->num_rows);
    //printf("%d total de .\n", $result->fetch_assoc);
    
    return $result->num_rows;

    
}



 
