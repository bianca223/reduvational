
<?php
  require_once('../Models/ArticoleModel.php');
  
  $general_params = array('id', 'nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status');
  
  
  class ArticoleSerializer {
    static function each($conn, $objects) {
      $response = array();
      foreach($objects as $obj) {
        array_push($response, array(
          'id' => $obj->id,
          'nume_articol' => $obj->nume_articol,
          'categorie' => $obj->categorie,
          'scrie' => $obj->scrie,
          'instagram' => $obj->instagram,
          'blog' => $obj->blog,
          'termen' => $obj->termen,
          'corectat' => $obj->corectat,
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
  }
  
?>
  