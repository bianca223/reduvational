
<?php
  require_once('ActiveRecords/ActiveRecords.php');
  require_once('Extensions/PlanuriLunareExtension.php');
  
  $accepted_params_post = array('id', 'nume_articol', 'categorie', 'de_scris', 'poze_instagram', 'poze_blog', 'termen', 'status', 'luna');
  
  
  $required_params_post = array('nume_articol', 'categorie', 'de_scris', 'poze_instagram', 'poze_blog', 'termen', 'status', 'luna');
  
  
  $accepted_params_update = array('id', 'nume_articol', 'categorie', 'de_scris', 'poze_instagram', 'poze_blog', 'termen', 'status', 'luna');
  
  
  $required_params_update = array('id');
  
  
  $accepted_params_delete = array('id');
  
  
  $required_params_delete = array('id');
  
  
  class PlanuriLunare extends PlanuriLunareExtension  {
    public $id;
    public $nume_articol;
    public $categorie;
    public $de_scris;
    public $poze_instagram;
    public $poze_blog;
    public $termen;
    public $status;
    public $luna;
    static $valTypes = array(
      'id' => 'int','nume_articol' => 'varchar','categorie' => 'varchar','de_scris' => 'varchar','poze_instagram' => 'varchar','poze_blog' => 'varchar','termen' => 'timestamp','status' => 'varchar','luna' => 'varchar'
    );
  
    public static function get($conn, $params) {
      $self = new PlanuriLunare;
      $response = getRecordByMulti($conn, $params, "reduvational", "planuri_lunare", new PlanuriLunare);
      if(!$response) {
        return NULL;
      } 
      
      if(array_key_exists("id", $response)) {
        $self->id = $response['id'];
      }
      if(array_key_exists("nume_articol", $response)) {
        $self->nume_articol = $response['nume_articol'];
      }
      if(array_key_exists("categorie", $response)) {
        $self->categorie = $response['categorie'];
      }
      if(array_key_exists("de_scris", $response)) {
        $self->de_scris = $response['de_scris'];
      }
      if(array_key_exists("poze_instagram", $response)) {
        $self->poze_instagram = $response['poze_instagram'];
      }
      if(array_key_exists("poze_blog", $response)) {
        $self->poze_blog = $response['poze_blog'];
      }
      if(array_key_exists("termen", $response)) {
        $self->termen = $response['termen'];
      }
      if(array_key_exists("status", $response)) {
        $self->status = $response['status'];
      }
      if(array_key_exists("luna", $response)) {
        $self->luna = $response['luna'];
      }
      return $self;
    }  

    public static function all($conn) {
      $result = array();
      $response = allTrunked($conn, "reduvational", "planuri_lunare", new PlanuriLunare, self::$valTypes);
      return $response;
    }

    public static function where($conn, $params) {
      $result = array();
      $response = whereRecordByMultiTrunk($conn, $params, "reduvational", "planuri_lunare", new PlanuriLunare, self::$valTypes);
      return $response;
    }

    public function tranfer($records) {
      $result = array();
      for($i = 0; $i < count($records); $i++) {
        $self = new PlanuriLunare;
        
      if(array_key_exists("id", $records[$i])) {
        $self->id = $records[$i]['id'];
      }
      if(array_key_exists("nume_articol", $records[$i])) {
        $self->nume_articol = $records[$i]['nume_articol'];
      }
      if(array_key_exists("categorie", $records[$i])) {
        $self->categorie = $records[$i]['categorie'];
      }
      if(array_key_exists("de_scris", $records[$i])) {
        $self->de_scris = $records[$i]['de_scris'];
      }
      if(array_key_exists("poze_instagram", $records[$i])) {
        $self->poze_instagram = $records[$i]['poze_instagram'];
      }
      if(array_key_exists("poze_blog", $records[$i])) {
        $self->poze_blog = $records[$i]['poze_blog'];
      }
      if(array_key_exists("termen", $records[$i])) {
        $self->termen = $records[$i]['termen'];
      }
      if(array_key_exists("status", $records[$i])) {
        $self->status = $records[$i]['status'];
      }
      if(array_key_exists("luna", $records[$i])) {
        $self->luna = $records[$i]['luna'];
      }
        array_push($result, $self);
      }
      return $result;
    }

    public static function insertMulti($conn, $records) {
      $response = multiInsert($conn, "reduvational", "planuri_lunare", $records, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      return 1;
    }

    public static function updateByIdMulti($conn, $records) {
      $response = updateByIdMulti($conn, "reduvational", "planuri_lunare", $records, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      $ids = array();
      foreach($records as $record) {
        array_push($ids, $record['id']);
      }
      return PlanuriLunare::where($conn, array(
        "id" => $ids
      ));
    } 

    public static function insert($conn, $params) {
      $response = insertGeneral($conn, "reduvational", "planuri_lunare", $params, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      
      return PlanuriLunare::get($conn, array(
        'id' => $response[1]
      ));
    }

    public static function objectCount($conn, $clause) {
      return getCount($conn, "reduvational", "planuri_lunare", $clause);
    }

    public function update($conn, $params) {
      $new = PlanuriLunare::get($conn, array(
        "id" => $this->id
      ));
      if(!$new) {
        return 0;
      }
      $response = updateById($conn, "reduvational", "planuri_lunare", "id", $new->id, $params, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      $new = PlanuriLunare::get($conn, array(
        "id" => $this->id
      ))->to_array();
      
      if(array_key_exists("id", $new)) {
        $this->id = $new['id'];
      }
      if(array_key_exists("nume_articol", $new)) {
        $this->nume_articol = $new['nume_articol'];
      }
      if(array_key_exists("categorie", $new)) {
        $this->categorie = $new['categorie'];
      }
      if(array_key_exists("de_scris", $new)) {
        $this->de_scris = $new['de_scris'];
      }
      if(array_key_exists("poze_instagram", $new)) {
        $this->poze_instagram = $new['poze_instagram'];
      }
      if(array_key_exists("poze_blog", $new)) {
        $this->poze_blog = $new['poze_blog'];
      }
      if(array_key_exists("termen", $new)) {
        $this->termen = $new['termen'];
      }
      if(array_key_exists("status", $new)) {
        $this->status = $new['status'];
      }
      if(array_key_exists("luna", $new)) {
        $this->luna = $new['luna'];
      }
      return 1;
    } 

    public static function pluck($conn, $param, $array) {
      $response = array();
      for($index = 0; $index < count($array); $index++) {
        $current_object = $array[$index]->to_array();
        if(array_key_exists($param, $current_object)) {
          array_push($response, $current_object[$param]);
        }
      }
      return $response;
    } 

    public function delete($conn) {
      $current = PlanuriLunare::get($conn, array(
        "id" => $this->id
      ));
      if(!$current) {
        return 0;
      }
      $current = $current->to_array();
      
      if(array_key_exists("id", $current)) {
        $this->id = $current['id'];
      }
      if(array_key_exists("nume_articol", $current)) {
        $this->nume_articol = $current['nume_articol'];
      }
      if(array_key_exists("categorie", $current)) {
        $this->categorie = $current['categorie'];
      }
      if(array_key_exists("de_scris", $current)) {
        $this->de_scris = $current['de_scris'];
      }
      if(array_key_exists("poze_instagram", $current)) {
        $this->poze_instagram = $current['poze_instagram'];
      }
      if(array_key_exists("poze_blog", $current)) {
        $this->poze_blog = $current['poze_blog'];
      }
      if(array_key_exists("termen", $current)) {
        $this->termen = $current['termen'];
      }
      if(array_key_exists("status", $current)) {
        $this->status = $current['status'];
      }
      if(array_key_exists("luna", $current)) {
        $this->luna = $current['luna'];
      }
      $response = deleteRecordBy($conn, "reduvational", "planuri_lunare", "id", $current["id"]);
      return $response[0];
    } 

    public static function execute($conn, $params) {
    } 

    public static function map_to_object($conn, $params) {
      $self = new PlanuriLunare;
      
      if(array_key_exists("id", $params)) {
        $self->id = $params['id'];
      }
      if(array_key_exists("nume_articol", $params)) {
        $self->nume_articol = $params['nume_articol'];
      }
      if(array_key_exists("categorie", $params)) {
        $self->categorie = $params['categorie'];
      }
      if(array_key_exists("de_scris", $params)) {
        $self->de_scris = $params['de_scris'];
      }
      if(array_key_exists("poze_instagram", $params)) {
        $self->poze_instagram = $params['poze_instagram'];
      }
      if(array_key_exists("poze_blog", $params)) {
        $self->poze_blog = $params['poze_blog'];
      }
      if(array_key_exists("termen", $params)) {
        $self->termen = $params['termen'];
      }
      if(array_key_exists("status", $params)) {
        $self->status = $params['status'];
      }
      if(array_key_exists("luna", $params)) {
        $self->luna = $params['luna'];
      }
      return $self;
    }

    public function save($conn) {

    }

    public function to_array() {
      return get_object_vars($this);
    } 
  }
  
?>
  