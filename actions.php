<?php 
 header('Access-Control-Allow-Origin: *'); 
 header("Access-Control-Allow-Credentials: true");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Max-Age: 1000');
 header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
 
require_once 'database.class.php'; 
$db = new DB();
$tblName = 'products'; 
  
$received_data=json_decode(file_get_contents('php://input'),1);
$data = array();

if($received_data['action'] == 'add')
{
    $data = array(
        'sku' => $received_data['sku'],
        'name' => $received_data['name'],
        'price' => $received_data['price'],
        'type' => $received_data['type'],
        'size' => $received_data['size'],
        'weight' => $received_data['weight'],
        'length' => $received_data['length'],
        'height' => $received_data['height'],
        'width' => $received_data['width'],
    );
    
    $check = $db->checkSKU($received_data['sku']);
    if($check){
        $insert = $db->insert($tblName, $data); 
        echo $insert ? "success" : "Product Couldn't be Added";
    }
    else{
        echo 'SKU not available';
    }
}
if($received_data['action'] == 'getProducts')
{
 $products = $db->getRows($tblName, array('order_by' => 'id'));
 echo json_encode($products);
}
if($received_data['action'] == 'deleteProducts')
{
    $err=0;
 foreach($received_data['ids'] as $id)
 {
    $conditions = array('id' => $id); 
    $db->delete($tblName, $conditions);
}
return "success";
}
exit;