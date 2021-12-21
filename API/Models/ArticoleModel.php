
<?php
  require_once('ActiveRecords/ActiveRecords.php');
  require_once('Extensions/ArticoleExtension.php');
  
  $accepted_params_post = array('id', 'nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  
  $required_params_post = array('nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  
  $accepted_params_update = array('id', 'nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  
  $required_params_update = array('id');
  
  
  $accepted_params_delete = array('id');
  
  
  $required_params_delete = array('id');
  
  
  class Articole extends ArticoleExtension  {
    public $id;
    public $nume_articol;
    public $categorie;
    public $scrie;
    public $instagram;
    public $blog;
    public $termen;
    public $corectat;
    public $status;
    public $data_postare;
    static $valTypes = array(
      'id' => 'int','nume_articol' => 'varchar','categorie' => 'varchar','scrie' => 'int','instagram' => 'int','blog' => 'int','termen' => 'timestamp','corectat' => 'int','status' => 'varchar','data_postare' => 'timestamp'
    );
  
    public static function get($conn, $params) {
      $self = new Articole;
      $response = getRecordByMulti($conn, $params, "reduvational", "articole", new Articole);
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
      if(array_key_exists("scrie", $response)) {
        $self->scrie = $response['scrie'];
      }
      if(array_key_exists("instagram", $response)) {
        $self->instagram = $response['instagram'];
      }
      if(array_key_exists("blog", $response)) {
        $self->blog = $response['blog'];
      }
      if(array_key_exists("termen", $response)) {
        $self->termen = $response['termen'];
      }
      if(array_key_exists("corectat", $response)) {
        $self->corectat = $response['corectat'];
      }
      if(array_key_exists("status", $response)) {
        $self->status = $response['status'];
      }
      if(array_key_exists("data_postare", $response)) {
        $self->data_postare = $response['data_postare'];
      }
      return $self;
    }  

    public static function all($conn) {
      $result = array();
      $response = allTrunked($conn, "reduvational", "articole", new Articole, self::$valTypes);
      return $response;
    }

    public static function where($conn, $params) {
      $result = array();
      $response = whereRecordByMultiTrunk($conn, $params, "reduvational", "articole", new Articole, self::$valTypes);
      return $response;
    }

    public function tranfer($records) {
      $result = array();
      for($i = 0; $i < count($records); $i++) {
        $self = new Articole;
        
      if(array_key_exists("id", $records[$i])) {
        $self->id = $records[$i]['id'];
      }
      if(array_key_exists("nume_articol", $records[$i])) {
        $self->nume_articol = $records[$i]['nume_articol'];
      }
      if(array_key_exists("categorie", $records[$i])) {
        $self->categorie = $records[$i]['categorie'];
      }
      if(array_key_exists("scrie", $records[$i])) {
        $self->scrie = $records[$i]['scrie'];
      }
      if(array_key_exists("instagram", $records[$i])) {
        $self->instagram = $records[$i]['instagram'];
      }
      if(array_key_exists("blog", $records[$i])) {
        $self->blog = $records[$i]['blog'];
      }
      if(array_key_exists("termen", $records[$i])) {
        $self->termen = $records[$i]['termen'];
      }
      if(array_key_exists("corectat", $records[$i])) {
        $self->corectat = $records[$i]['corectat'];
      }
      if(array_key_exists("status", $records[$i])) {
        $self->status = $records[$i]['status'];
      }
      if(array_key_exists("data_postare", $records[$i])) {
        $self->data_postare = $records[$i]['data_postare'];
      }
        array_push($result, $self);
      }
      return $result;
    }

    public static function insertMulti($conn, $records) {
      $response = multiInsert($conn, "reduvational", "articole", $records, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      return 1;
    }

    public static function updateByIdMulti($conn, $records) {
      $response = updateByIdMulti($conn, "reduvational", "articole", $records, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      $ids = array();
      foreach($records as $record) {
        array_push($ids, $record['id']);
      }
      return Articole::where($conn, array(
        "id" => $ids
      ));
    } 

    public static function insert($conn, $params) {
      $response = insertGeneral($conn, "reduvational", "articole", $params, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      
      return Articole::get($conn, array(
        'id' => $response[1]
      ));
    }

    public static function objectCount($conn, $clause) {
      return getCount($conn, "reduvational", "articole", $clause);
    }

    public function update($conn, $params) {
      $new = Articole::get($conn, array(
        "id" => $this->id
      ));
      if(!$new) {
        return 0;
      }
      $response = updateById($conn, "reduvational", "articole", "id", $new->id, $params, self::$valTypes);
      if(!$response[0]) {
        return 0;
      }
      $new = Articole::get($conn, array(
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
      if(array_key_exists("scrie", $new)) {
        $this->scrie = $new['scrie'];
      }
      if(array_key_exists("instagram", $new)) {
        $this->instagram = $new['instagram'];
      }
      if(array_key_exists("blog", $new)) {
        $this->blog = $new['blog'];
      }
      if(array_key_exists("termen", $new)) {
        $this->termen = $new['termen'];
      }
      if(array_key_exists("corectat", $new)) {
        $this->corectat = $new['corectat'];
      }
      if(array_key_exists("status", $new)) {
        $this->status = $new['status'];
      }
      if(array_key_exists("data_postare", $new)) {
        $this->data_postare = $new['data_postare'];
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
      $current = Articole::get($conn, array(
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
      if(array_key_exists("scrie", $current)) {
        $this->scrie = $current['scrie'];
      }
      if(array_key_exists("instagram", $current)) {
        $this->instagram = $current['instagram'];
      }
      if(array_key_exists("blog", $current)) {
        $this->blog = $current['blog'];
      }
      if(array_key_exists("termen", $current)) {
        $this->termen = $current['termen'];
      }
      if(array_key_exists("corectat", $current)) {
        $this->corectat = $current['corectat'];
      }
      if(array_key_exists("status", $current)) {
        $this->status = $current['status'];
      }
      if(array_key_exists("data_postare", $current)) {
        $this->data_postare = $current['data_postare'];
      }
      $response = deleteRecordBy($conn, "reduvational", "articole", "id", $current["id"]);
      return $response[0];
    } 

    public static function execute($conn, $params) {
    } 

    public static function map_to_object($conn, $params) {
      $self = new Articole;
      
      if(array_key_exists("id", $params)) {
        $self->id = $params['id'];
      }
      if(array_key_exists("nume_articol", $params)) {
        $self->nume_articol = $params['nume_articol'];
      }
      if(array_key_exists("categorie", $params)) {
        $self->categorie = $params['categorie'];
      }
      if(array_key_exists("scrie", $params)) {
        $self->scrie = $params['scrie'];
      }
      if(array_key_exists("instagram", $params)) {
        $self->instagram = $params['instagram'];
      }
      if(array_key_exists("blog", $params)) {
        $self->blog = $params['blog'];
      }
      if(array_key_exists("termen", $params)) {
        $self->termen = $params['termen'];
      }
      if(array_key_exists("corectat", $params)) {
        $self->corectat = $params['corectat'];
      }
      if(array_key_exists("status", $params)) {
        $self->status = $params['status'];
      }
      if(array_key_exists("data_postare", $params)) {
        $self->data_postare = $params['data_postare'];
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
  