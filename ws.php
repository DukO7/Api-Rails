<?php
date_default_timezone_set("America/Mexico_City");
include_once('db.php');

class WebService{
public function run($clase){
switch($clase){
    case 'usuarios':
    return (new Usuarios())->run($_GET['method']);
   }
}

}


class Usuarios{
    public function run($method){
        switch($method){
            case 'post':
            return $this->post($_GET['params']);
        }

    }

    public function post($params){
        $sql = new db();
        $sql->q("INSERT INTO usuarios VALUES(NULL, '$params[id_personales]','$params[rol]','$params[clave]')");
        return array(
            'response' => 'true',
            'last_insert_id' => $sql->last('usuarios')
        );
    }
}

$w = new WebService();
echo json_encode($w->run($_GET['class']));

?>