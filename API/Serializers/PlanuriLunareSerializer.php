
<?php
  require_once('../Models/PlanuriLunareModel.php');
  
  $general_params = array('id', 'nume_articol', 'categorie', 'de_scris', 'poze_instagram', 'poze_blog', 'termen', 'status', 'luna');
  
  
  class PlanuriLunareSerializer {
    static function each($conn, $objects) {
      $response = array();
      foreach($objects as $obj) {
        array_push($response, array(
          'id' => $obj->id,
          'nume_articol' => $obj->nume_articol,
          'categorie' => $obj->categorie,
          'de_scris' => $obj->de_scris,
          'poze_instagram' => $obj->poze_instagram,
          'poze_blog' => $obj->poze_blog,
          'termen' => $obj->termen,
          'status' => $obj->status,
          'luna' => $obj->luna,
        ));
      }
      return $response;
    }
    static function once($conn, $obj) {
      return array(
        'id' => $obj->id,
          'nume_articol' => $obj->nume_articol,
          'categorie' => $obj->categorie,
          'de_scris' => $obj->de_scris,
          'poze_instagram' => $obj->poze_instagram,
          'poze_blog' => $obj->poze_blog,
          'termen' => $obj->termen,
          'status' => $obj->status,
          'luna' => $obj->luna,
      );
    }
  }
  
?>
  