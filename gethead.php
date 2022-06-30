<?php

$cl=$DATA_OBJECT->class;
$yr=$DATA_OBJECT->year;
$tb="";


$sql=false;
$sql="SELECT * FROM pupils WHERE class=$cl and year=$yr LIMIT 1";
$results=$DB->read($sql,[]);

if (is_array($results)) {
    $results=$results[0];
    $total=($results->term1fees)+($results->term2fees)+($results->term3fees);

    $tb.= "
    
    <table width='100%'  class='content-table' >
    <thead>
      <tr >
      <th>MONTH</th>
      <th>HEAD</th>
      <th >ACTIONS</th>
      
      </tr>
    </thead>
    <tbody>
      
      
      <tr>
        <td>Term 1</td>
        <td>$results->term1fees</td>
        <td ><img style='cursor:pointer' class='$cl' onclick='headmod(event)' id='term1fees' src='./images/delete.png' width='15px' height='15px' /></td>
    
      </tr>
      
      <tr>
        <td>Term 2</td>
        <td>$results->term2fees</td>
        <td ><img style='cursor:pointer'  class='$results->userid'  onclick='headmod(event)' id='term2fees' src='./images/delete.png' width='15px' height='15px' /></td>
    
      </tr>
      
      
      <tr>
        <td>Term 3</td>
        <td>$results->term3fees</td>
        <td ><img style='cursor:pointer'  class='$results->userid' onclick='headmod(event)' id='term3fees' src='./images/delete.png' width='15px' height='15px' /></td>
    
      </tr>
      <tr>
      <th scope='row'>Total</th>
      <th  scope='row'>$total</th>
      <td ></td>
  
    </tr>
      
      
   </tbody>
   </table>
    ";
    
    $info->message =$tb;
  
    $info->type = "head";
    echo json_encode($info);
    
}else {
    $tb.= "<p > <h6 style='color:red'> No votehead set for $yr in class $cl </h6> <p>";
    
    $info->message =$tb;
  
    $info->type = "head";
    echo json_encode($info);
}