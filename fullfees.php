<?php


// print_r($DATA_OBJECT);
// die;


$id=$DATA_OBJECT->id;
 $y=$DATA_OBJECT->year;

 $str="";
 
 $sql = false;
 $sql = "SELECT  * FROM pupils WHERE userid='$id' and year =$y";
 $res = $DB->read($sql, []);





 $term2 = "";
 $balance = "";
 $sum = array();

 if (is_array($res)) {
   // echo "<pre>";
   // print_r($res);

  $res=$res[0];

  if ($res->term1fees!=0) {
    $str.="
    <tr >
          <th >1</th>
          <td>$res->term1fees</td>
          <td>$res->term1paid</td>
          
          <td style='color: red'>$res->term1balance</td>
          
    </tr>";
  }
  if ($res->term2fees!=0) {
    $str.= "
    <tr >
          <th >2</th>
          <td>$res->term2fees</td>
          <td>$res->term2paid</td>
          
          <td style='color: red'>$res->term2balance</td>

    </tr>";
  }
  if ($res->term3fees!=0) {
    $str.="
    <tr >
          <th >3</th>
          <td>$res->term3fees</td>
          <td>$res->term3paid</td>
          
          <td style='color: red'>$res->term3balance</td>
   
    </tr>";
  }


  $balance=($res->term1balance)+($res->term2balance)+($res->term3balance);
                    
                   $str.= "
                    
                    <tr>
                    <th rowspan='4'>BALANCE</th>
              
                    <td></td>
                    <td></td>

                    <th style='color: red;'><b>$balance </b></th>
                    <td style='padding:10px 3px ;'></td>
                  </tr>
                    ";

                    $info->message=$str;
$info->type='fullfees';
echo json_encode($info);


 }
 else{

    $info->message="<div style='width:100%;height:100%;display:flex;justify-content:center;align-items:center;'>
    
    <p style='color:red'>Fees for year $y haven't been set or paid</p>
            </div>";
$info->type='fullfees';
echo json_encode($info);
}






















// $sql = false;
// $sql = "SELECT  * FROM fees WHERE userid='$id' and year=$y";
// $res = $DB->read($sql, []);





// $term2 = "";
// $balance = "";
// $mess="";
// $sum = array();

// if (is_array($res)) {
//     // echo "<pre>";
//     // print_r($res);



//     foreach ($res as $key) {

//         array_push($sum, $key->balance);

//         if ($key->lastyear!=0) {
//             array_push($sum, $key->lastyear);
//             $term2 .= "
//             <tr id='$key->userid'>
//                   <th id='$key->userid' >LastYear</th>
//                   <td id='$key->userid'></td>
//                   <td id='$key->userid'></td>
//                   <td style='color: red;'>$key->lastyear</td>
//                   <td style='padding:10px 3px ;'><img onclick='stmtmod(event)' id='$key->id' src='./images/delete.png' width='15px' height='15px' /></td>
//             </tr>
//             ";
            
//         }


//         if ($key->lastyear==0) {
//              $term2 .= "
//             <tr id='$key->userid'>
//                   <th id='$key->userid' >$key->month</th>
//                   <td id='$key->userid'>$key->fees</td>
//                   <td id='$key->userid'>$key->paid</td>
//                   <td style='color: red;'>$key->balance</td>
//                   <td style='padding:10px 3px ;'><img onclick='stmtmod(event)' id='$key->id' src='./images/delete.png' width='15px' height='15px' /></td>
//             </tr>
//             ";
//         }
       
//     }


//     $balance = array_sum($sum);

   
    
// $mess.="
// <table width='100%' class='content-table'>
//     <thead>
//         <tr>
//             <th>MONTH</th>
//             <th>FEES</th>
//             <th>PAID</th>
//             <th>BALANCE</th>
//             <th style='padding:10px 3px ;'>ACTIONS</th>
//         </tr>
//     </thead>
//     <tbody>


//         <tr>
//              $term2 

//         </tr>
      



// ";

// if ($balance > 0) {
// $mess.= "
    
//     <tr>
//     <th rowspan='4'>BALANCE</th>
//     <!-- <td rowspan='3'>ITEM 2</td> -->
//     <td></td>
//     <td></td>

//     <th style='color: red;'><b>
//                                  $balance </b></th>
//   </tr>
//     ";
// }

// $info->message=$mess;
// $info->type='fullfees';
// echo json_encode($info);

// }else{

//     $info->message="<div style='width:100%;height:100%;display:flex;justify-content:center;align-items:center;'>
    
//     <p style='color:red'>Fees for year $y haven't been set or paid</p>
//             </div>";
// $info->type='fullfees';
// echo json_encode($info);
// }


// 
