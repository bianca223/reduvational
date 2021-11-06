
<?php
  require_once('../Models/MembriModel.php');
  
  $general_params = array('id', 'numele');
  
  
  class MembriSerializer {
    static function each($conn, $objects) {
      $response = array();
      foreach($objects as $obj) {
        array_push($response, array(
          'id' => $obj->id,
          'numele' => $obj->numele,
        ));
      }
      return $response;
    }
    static function once($conn, $obj) {
      return array(
        'id' => $obj->id,
          'numele' => $obj->numele,
      );
    }
  }
  
?>
  