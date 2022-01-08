
<?php
  require_once('../Models/ArticoleModel.php');
  require_once('../Models/MembriModel.php');
  
  $general_params = array('id', 'nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  class ArticoleSerializer {
    static function each($conn, $objects) {
      $membrii = imap(Membri::all($conn)->fetch(), "id");
      $response = array();
      foreach($objects as $obj) {
        array_push($response, array(
          'id' => $obj->id,
          'nume_articol' => $obj->nume_articol,
          'categorie' => $obj->categorie,
          'scrie' => $membrii[$obj->scrie]->numele,
          'instagram' => $membrii[$obj->instagram]->numele,
          'blog' => $membrii[$obj->blog]->numele,
          'termen' => $obj->termen,
          'corectat' => $membrii[$obj->corectat]->numele,
          'status' => $obj->status,
        ));
      }
      return $response;
    }
    static function once($conn, $obj) {
      return array(
        'id' => $obj->id,
          'nume_articol' => $obj->nume_articol,
          'categorie' => $obj->categorie,
          'scrie' => $obj->scrie,
          'instagram' => $obj->instagram,
          'blog' => $obj->blog,
          'termen' => $obj->termen,
          'corectat' => $obj->corectat,
          'status' => $obj->status,
      );
    }
    static function prepare($conn, $objects, $users) {
      $data = array();
      foreach($objects as $obj){
        if($obj->status != "terminat" && $obj->status != "postat"){
          foreach($users as $usr){
            $check = getJobUsers($obj, $usr->id);
            if($check){
              if(!array_key_exists($usr->id, $data)){
                $data[$usr->id] = array();
              }
              $diff = strtotime($obj->termen) - time();
              $days=floor($diff/(60*60*24));
              $hours=round(($diff-$days*60*60*24)/(60*60));
              array_push($data[$usr->id], array(
                "id" => $obj->id,
                "nume_articol" => $obj->nume_articol,
                "job" => $check,
                "termen" => "day: $days, ore: $hours"
              ));
            }
            
          }
        }
      }
      return $data;
    }
  }
  function getJobUsers($obj, $id){
    foreach($obj as $key => $value){
      if($key == 'scrie' || $key == 'blog' || $key == 'instagram' || $key == 'corectat'){
        if($key == $obj->status){
          if($value == $id){
            return $key;
          }
        }
        
      }
    }
    return 0;
  }
  
?>
  