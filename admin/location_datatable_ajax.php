<?php
$servername = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "carencure";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$requestData= $_REQUEST;
$columns = array( 
    0 =>'id', 
    1 => 'name',
    2=> 'id'
);
$sql = "SELECT * ";
$sql.=" FROM locations";
$query=mysqli_query($conn, $sql) or die("location_datatable_ajax.php: get locations");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;
if( !empty($requestData['search']['value']) ) {
    $sql = "SELECT * ";
    $sql.=" FROM locations";
    $sql.=" WHERE name LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($conn, $sql) or die("location_datatable_ajax.php: get locations");
    $totalFiltered = mysqli_num_rows($query); 
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("location_datatable_ajax.php: get locationss");
} else {    
    $sql = "SELECT * ";
    $sql.=" FROM locations";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("location_datatable_ajax.php: get locations");
}
$data = array();
$i=0;
while( $row=mysqli_fetch_array($query) ) { 
    $i++;
    $nestedData=array(); 
    $nestedData['id']=$row["id"];
    $nestedData['key']=$i;
    $nestedData['name']=$row["name"];
    $nestedData['action']='s';
    $data[] = $nestedData;
}
$json_data = array(
    "draw"           =>intval($requestData['draw']),
    "recordsTotal"   =>intval($totalData), 
    "recordsFiltered"=>intval($totalFiltered),
    "data"           =>$data 
);
echo json_encode($json_data);
?>