
<?php
  require_once('ControllerLib/ControllerWatch.php');
  require_once('../Models/MembriModel.php');
  require_once('../Serializers/MembriSerializer.php');
  
  $accepted_params_post = array('id', 'numele');
  
  
  $required_params_post = array('numele');
  
  
  $accepted_params_update = array('id', 'numele');
  
  
  $required_params_update = array('id');
  
  
  $accepted_params_delete = array('id');
  
  
  $required_params_delete = array('id');
  
  
  $search_params = array('id', 'numele');
  
  
  class MembriController {
    public static function get($params) {
      
    $conn = mysqli_connect();
  
      mysqli_select_db($conn, "reduvational");
      $page = 1;
      $per_page = 20;
      $orderBy = 'id';
      $orderType = 'ASC';
      $n_page = getCurrentUrlValue('page');
      $n_per_page = getCurrentUrlValue('per_page');
      if($n_page && is_numeric($page)) {
        $page = $n_page;
      }
      if($n_per_page && is_numeric($per_page)) {
        $per_page = $n_per_page;
      }
      $countRecords = 0;
      $isLike = getCurrentUrlValue('like');
      $newOrderBy = getCurrentUrlValue('orderBy');
      $newOrderType = getCurrentUrlValue('orderType');
      if($newOrderBy) {
        $orderBy = $newOrderBy;
      }
      if($newOrderType) {
        $orderType = $newOrderType;
      }
      $allRecords = array();
      $searchParams = array(
        "page" => $page,
        "per_page" => $per_page,
        "orderBy" => $orderBy,
        "orderType" => $orderType
      );
      if($isLike && ($isLike === "true" || $isLike === true)) {
        if(count($params) !== 1) {
          return array(
            "Error" => "Daca 'like' este activ, nu pot fi mai mult de 1 parametru!"
          );
        }
        $allRecords = generalLike($conn, 'Membri', $params, $searchParams);
        $countRecords = generalLikeCount($conn, 'Membri', $params, $searchParams);
      }
      else  {
        $allRecords = generalGet($conn, 'Membri', $params, $searchParams);
        $countRecords = generalGetCount($conn, 'Membri', $params, $searchParams);
      }
      $maxPages = intval($countRecords / $per_page) + ($countRecords % $per_page != 0);
      mysqli_close($conn);
      return array(
        "records" => MembriSerializer::each($conn, $allRecords),
        "count" => $countRecords,
        "totalPages" => $maxPages
      );
    }
    public static function post($params) {
      
    $conn = mysqli_connect();
  
      mysqli_select_db($conn, "reduvational");
      $conn->autocommit(FALSE);
      $obj = Membri::insert($conn, $params);
      if(!$obj) {
        $conn->rollback();
        return array(
          "Error" => "Nu s-a putut inregistra recordul Membri!"
        );
      }
      $conn->commit();
      mysqli_close($conn);
      return MembriSerializer::once($conn, $obj);
    }
    public static function update($params) {
      
    $conn = mysqli_connect();
  
      mysqli_select_db($conn, "reduvational");
      $conn->autocommit(FALSE);
      $obj = Membri::get($conn, array(
        'id' => $params['id']
      ));
      if(!$obj) {
        $conn->rollback();
        $id = $params['id'];
        return array(
          "Error" => "Nu s-a putut gasi recordul obiectului Membri cu id $id!"
        );
      }
      unset($params['id']);
      if(!$obj->update($conn, $params)) {
        $conn->rollback();
        return array(
          "Error" => "Nu s-a putut face update la recordul Membri!"
        );
      }
      $conn->commit();
      mysqli_close($conn);
      return MembriSerializer::once($conn, $obj);
    }
    public static function delete($params) {
      
    $conn = mysqli_connect();
  
      mysqli_select_db($conn, "reduvational");
      $conn->autocommit(FALSE);
      $obj = Membri::get($conn, array(
        'id' => $params['id']
      ));
      if(!$obj) {
        $conn->rollback();
        $id = $params['id'];
        return array(
          "Error" => "Nu s-a putut gasi recordul obiectului Membri cu id $id!"
        );
      }
      if(!$obj->delete($conn, $params)) {
        $conn->rollback();
        return array(
          "Error" => "Nu s-a putut sterge recordul Membri!"
        );
      }
      $conn->commit();
      mysqli_close($conn);
      return MembriSerializer::once($conn, $obj);
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $params = array();
    foreach($search_params as $key) {
      $value = getCurrentUrlValue($key);
      if($value) {
        $params[$key] = $value;
      }
    }
    echo json_encode(MembriController::get($params));
    return ;
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = $_POST;
    if(getCurrentUrlValue('patch') && getCurrentUrlValue('patch') == true) {
      $errs = checkAcceptedParams($accepted_params_update, $_POST);
      if(strlen($errs)) {
        http_response_code(400);
        echo json_encode(array(
          "Error" => $errs
        ));
        return ;
      }
      $errs = checkRequiredParams($required_params_update, $_POST);
      if(strlen($errs)) {
        http_response_code(400);
        echo json_encode(array(
          "Error" => $errs
        ));
        return ;
      }
      $response = MembriController::update($params);
      if(array_key_exists("Error", $response)) {
        http_response_code(400);
        echo json_encode($response);
        return ;
      }
      echo json_encode($response);
      return ;
    }
    $errs = checkAcceptedParams($accepted_params_post, $_POST);
    if(strlen($errs)) {
      http_response_code(400);
      echo json_encode(array(
        "Error" => $errs
      ));
      return ;
    }
    $errs = checkRequiredParams($required_params_post, $_POST);
    if(strlen($errs)) {
      http_response_code(400);
      echo json_encode(array(
        "Error" => $errs
      ));
      return ;
    }
    $response = MembriController::post($params);
    if(array_key_exists("Error", $response)) {
      http_response_code(400);
      echo json_encode($response);
      return ;
    }
    echo json_encode($response);
    return ;
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
    $response = MembriController::delete($params);
    if(array_key_exists("Error", $response)) {
      http_response_code(400);
      echo json_encode($response);
      return ;
    }
    echo json_encode($response);
    return ;
  }
  http_response_code(401);
  echo json_encode($error_code);
  
?>
  