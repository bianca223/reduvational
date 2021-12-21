
<?php
  require_once('ControllerLib/ControllerWatch.php');
  require_once('../Models/ArticoleModel.php');
  require_once('../Models/MembriModel.php');
  require_once('../Serializers/ArticoleSerializer.php');

  $accepted_params_post = array('id', 'nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  
  $required_params_post = array('nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  
  $accepted_params_update = array('id', 'nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  
  $required_params_update = array('id');
  
  
  $accepted_params_delete = array('id');
  
  
  $required_params_delete = array('id');
  
  
  $search_params = array('id', 'nume_articol', 'categorie', 'scrie', 'instagram', 'blog', 'termen', 'corectat', 'status', 'data_postare');
  
  
  class ArticoleController {
    public static function get($params) {
      $servername = "localhost";
      $username = "root";
      $password = "12345678";
      $conn = new mysqli($servername, $username, $password);  
      //$conn = mysqli_connect();
  
      mysqli_select_db($conn, "reduvational");
      if($params === 'status'){
        $params = ['scrie', 'instagram', 'blog', 'corectat'];
      }
      $obj = Articole::where($conn, array(
        "status" => $params
      ))->fetch();
      $response = ArticoleSerializer::each($conn,$obj);
      mysqli_close($conn);
      return $response;
    }
    public static function post($params) {
      $servername = "localhost";
      $username = "root";
      $password = "12345678";
      $conn = new mysqli($servername, $username, $password);
      //$conn = mysqli_connect();
      mysqli_select_db($conn, "reduvational");
      
      $conn->autocommit(false);
      if($params && count($params) === 7){
        
        $membri = imap(Membri::all($conn)->fetch(),"numele");
        $obj = Articole::insert($conn, array(
          "nume_articol" => $params['nume_articol'],
          "categorie" => $params['categorie'],
          'scrie' => $membri[$params['scrie']]->id,
          'instagram' =>  $membri[$params['instagram']]->id,
          'blog' =>  $membri[$params['blog']]->id,
          'corectat' => $membri[$params['corectat']]->id,
          'termen' => $params['termen'],
          "status" => "scrie"
        ));
        if(!$obj) {
          $conn->rollback();
          return array(
            "Error" => "Nu s-a putut inregistra recordul Articole!"
          );
        }
        $response = ArticoleSerializer::once($conn, $obj);
        $conn->commit();
        mysqli_close($conn);
        return $response;
      }
      return array(
        "Error" => "Ai uitat un capm liber"
      );
      
    }
    public static function getToDo(){
      $servername = "localhost";
      $username = "root";
      $password = "12345678";
      $conn = new mysqli($servername, $username, $password);
      mysqli_select_db($conn, "reduvational");
      $conn->autocommit(FALSE);
      $obj = Articole::all($conn)->fetch();
      $users = Membri::all($conn)->fetch();
      $conn->commit();
      $response = ArticoleSerializer::prepare($conn, $obj, $users);
      mysqli_close($conn);
      return $response;
    }
    public static function update($params) {
      $servername = "localhost";
      $username = "root";
      $password = "12345678";
      $conn = new mysqli($servername, $username, $password);  
  
      mysqli_select_db($conn, "reduvational");
      $conn->autocommit(FALSE);
      $obj = Articole::get($conn, array(
        'id' => $params['id']
      ));
      if(!$obj) {
        $conn->rollback();
        $id = $params['id'];
        return array(
          "Error" => "Nu s-a putut gasi recordul obiectului Articole cu id $id!"
        );
      }
      unset($params['id']);
      if(!$obj->update($conn, $params)) {
        $conn->rollback();
        return array(
          "Error" => "Nu s-a putut face update la recordul Articole!"
        );
      }
      $response = ArticoleSerializer::once($conn, $obj);
      $conn->commit();
      mysqli_close($conn);
      return $response;
    }
    public static function updateStatus($params) {
      $servername = "localhost";
      $username = "root";
      $password = "12345678";
      $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn, "reduvational");
        $conn->autocommit(FALSE);
        $obj = Articole::get($conn, array(
          'id' => $params['id']
        ));
        if(!$obj) {
          $conn->rollback();
          $id = $params['id'];
          return array(
            "Error" => "Nu s-a putut gasi recordul obiectului Articole cu id $id!"
          );
        }
        $status['status'] = 'terminat';
        // if($obj->status == 'trimis'){
        //   $status['status'] = 'scrie';
        // }
        if($obj->status == 'scrie'){
          $status['status']  = 'instagram';
        }
        if($obj->status == 'instagram'){
          $status['status']  = 'blog';
        }
        if($obj->status == 'blog'){
          $status['status'] = 'corectat';
        }
        if(!$obj->update($conn, $status)) {
          $conn->rollback();
          return array(
            "Error" => "Nu s-a putut face update la recordul Articole!"
          );
        }
        $response = ArticoleSerializer::once($conn, $obj);
        $conn->commit();
        mysqli_close($conn);
        return $response;
      }
    public static function delete($params) {
      
    $conn = mysqli_connect();
  
      mysqli_select_db($conn, "reduvational");
      $conn->autocommit(FALSE);
      $obj = Articole::get($conn, array(
        'id' => $params['id']
      ));
      if(!$obj) {
        $conn->rollback();
        $id = $params['id'];
        return array(
          "Error" => "Nu s-a putut gasi recordul obiectului Articole cu id $id!"
        );
      }
      if(!$obj->delete($conn, $params)) {
        $conn->rollback();
        return array(
          "Error" => "Nu s-a putut sterge recordul Articole!"
        );
      }
      $conn->commit();
      mysqli_close($conn);
      return ArticoleSerializer::once($conn, $obj);
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(getCurrentUrlValue('status') && getCurrentUrlValue('status') == true) {
      echo json_encode(ArticoleController::get('status'));
      return ;
    }
    if(getCurrentUrlValue('terminat') && getCurrentUrlValue('terminat') == true) {
      echo json_encode(ArticoleController::get('terminat'));
      return ;
    }
    if(getCurrentUrlValue('postat') && getCurrentUrlValue('postat') == true) {
      echo json_encode(ArticoleController::get('postat'));
      return ;
    }
    if(getCurrentUrlValue('toDo') && getCurrentUrlValue('toDo') == true) {
      echo json_encode(ArticoleController::getToDo());
      return ;
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = $_POST;
    if(getCurrentUrlValue('adaugare') && getCurrentUrlValue('adaugare') == true) {
      $response = ArticoleController::post($params);
      if(array_key_exists("Error", $response)) {
        http_response_code(400);
        echo json_encode($response);
        return ;
      }
      echo json_encode($response);
      return ;
    }
    if(getCurrentUrlValue('pregatit') && getCurrentUrlValue('pregatit') == true) {
      $response = ArticoleController::update($params);
      if(array_key_exists("Error", $response)) {
        http_response_code(400);
        echo json_encode($response);
        return ;
      }
      echo json_encode($response);
      return ;
    }   
    if(getCurrentUrlValue('next') && getCurrentUrlValue('next') == true) {
      $params['id'] = getCurrentUrlValue('id');
      $response = ArticoleController::updateStatus($params);
      if(array_key_exists("Error", $response)) {
        http_response_code(400);
        echo json_encode($response);
        return ;
      }
      echo json_encode($response);
      return ;
    }
    if(getCurrentUrlValue('update') && getCurrentUrlValue('update') == true) {
      $response = ArticoleController::update($params);
      if(array_key_exists("Error", $response)) {
        http_response_code(400);
        echo json_encode($response);
        return ;
      }
      echo json_encode($response);
      return ;
    } 
  }
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $params = $_GET;
    $errs = checkAcceptedParams($accepted_params_delete, $params);
    if(strlen($errs)) {
      http_response_code(400);
      echo json_encode(array(
        "Error" => $errs
      ));
      return ;
    }
    $errs = checkRequiredParams($required_params_delete, $params);
    if(strlen($errs)) {
      http_response_code(400);
      echo json_encode(array(
        "Error" => $errs
      ));
      return ;
    }
    $response = ArticoleController::delete($params);
    if(array_key_exists("Error", $response)) {
      http_response_code(400);
      echo json_encode($response);
      return ;
    }
    echo json_encode($response);
    return ;
  }
?>
  