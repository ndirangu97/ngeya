<?php



$id = $DATA_OBJECT->id;


$fees = $DATA_OBJECT->fees;
$yer = $DATA_OBJECT->year;
$fee = $DATA_OBJECT->term . 'paid';
$head = $DATA_OBJECT->term . 'fees';
$bl = $DATA_OBJECT->term . 'balance';

$err = "";
if (empty($DATA_OBJECT->no)) {
    $no = "";
} else {
    $no = $DATA_OBJECT->no;
}


$sql = false;


$sql = "SELECT * FROM pupils WHERE userid='$id' and year=$yer LIMIT 1";
$res = $DB->read($sql, []);
if (is_array($res)) {
    $res = $res[0];

    if ($res->$head == 0) {

        $info->message = " ERROR:VoteHead  has not been set";

        $info->type = "err";
        echo json_encode($info);
    } else {

        $query = false;
        $bal1 = ($res->term1fees) - ($fees);
        $feepaid = ($res->term1paid) + ($fees);

        $topay = ($res->$fee) + $fees;
        $query = "UPDATE pupils set $fee=$topay WHERE userid='$id' and year=$yer";
        $read = $DB->write($query, []);
        if ($read) {

            $sql = false;


            $sql = "SELECT * FROM pupils WHERE userid='$id' and year=$yer LIMIT 1";
            $resb = $DB->read($sql, []);
            if (is_array($resb)) {
                $resb = $resb[0];

                $balance = ($resb->$head) - ($resb->$fee);

                $query = false;


                $query = "UPDATE pupils set $bl=$balance WHERE userid='$id' and year =$yer";
                $readpy = $DB->write($query, []);
                if ($readpy) {

                    $query = false;
                    $clerk = 'Truphena';
                    $datem = date('Y-m-d');
                    $time = date('H:i');

                    if ($DATA_OBJECT->term == 'term1') {
                        $tn = 1;
                        $fee = $resb->term1fees;
                    }
                    if ($DATA_OBJECT->term == 'term2') {
                        $tn = 2;
                        $fee = $resb->term2fees;
                    }
                    if ($DATA_OBJECT->term == 'term3') {
                        $tn = 3;
                        $fee = $resb->term3fees;
                    }


                    $query = "INSERT into statement(userid,term,fees,paid,balance,clerk,date,time,year,recieptno) VALUES('$id','$tn',$fee,$fees,$balance,'$clerk','$datem','$time',$yer,'$no')";
                    $stmt = $DB->write($query, []);
                    if ($stmt) {

                        $query = false;
                        $datem2 = date('Y-m-d');
                        $name=$resb->name;


                        $query = "INSERT into activity(name,date,amount,time,clerk,balance) VALUES('$name','$datem2',$fees,'$time','$clerk',$balance)";
                        $act = $DB->write($query, []);
                        if ($act) {
                            $acti = 0;
                        } else {
                            $actids = 0;
                        }

                        $info->message = "Fess payed Succefully";

                        $info->type = "pay";
                        echo json_encode($info);
                    } else {
                        $info->message = "Statement not created";

                        $info->type = "err";
                        echo json_encode($info);
                    }
                }
            }

            // $sql = false;


            // $sql = "SELECT * FROM pupils WHERE userid='$id' and year=$yer LIMIT 1";
            // $resp = $DB->read($sql, []);
            // if (is_array($resp)) {
            //         $resp=$resp[0];
            //         $balst=($resp->term1fees)-($resp->term1paid);
            // }

            // $query=false;
            // $clerk='Truphena';
            // $datem=date('d-m');
            // $time=date('H:i');
            // $t1f=$res->term1fees;

            // $query="INSERT into statement(userid,term,fees,paid,balance,clerk,date,time,year,recieptno) VALUES('$id','$tn',$t1f,$fees,$balst,'$clerk','$datem','$time',$yer,'$no')";
            // $stmt=$DB->write($query,[]);
            // if ($stmt) {
            //     $info->message = "Fess payed Succefully";

            //     $info->type = "pay";
            //     echo json_encode($info);


            // }else {
            //     $info->message = "Statement not created";

            //     $info->type = "err";
            //     echo json_encode($info);
            // }
        } else {
            $err = 'OOPs!!!!Something went wrong';
        }
    }
} else {
    $info->message = "ERROR : Student not nound";

    $info->type = "pay";
    echo json_encode($info);
}
// if (is_array($res)) {
//     $res = $res[0];
//     $query = false;


//     $set = $res->$mth;
//     $bal = ($set) - ($fees);

//     if ($set == 0) {

//         $info->message = " ERROR:VoteHead  for $tn  has not been set";

//         $info->type = "err";
//         echo json_encode($info);
//     } else {


//         $sql = false;
//         $sql = "SELECT * FROM fees WHERE userid='$id' and year=$yer";
//         $fes = $DB->read($sql, []);
//         if (is_array($fes)) {
//             if ($tn=='1') {
//                 foreach ($fes as $row) {
//                     if ($row->month == $mth) {
//                         $md = strtoupper($mth);
//                         $err = "error";
//                         $info->message = "$md fees have already been payed.";
    
//                         $info->type = "err";
//                         echo json_encode($info);
//                     }
//                 }
//             }
           
//             if ($err == "") {
//                 $query=false;
//                 $query = "INSERT INTO fees(userid,month,term,fees,paid,balance,year,recieptno,recieptdate) VALUES('$id','$mth',$tn,$set,$fees,$bal,$yer,'$no','$dt') ";
//                 $read = $DB->write($query, []);
//                 if ($read) {
                   
//                     $query=false;
//                     $clerk='Truphena';
//                     $datem=date('d-m');
//                     $time=date('H:i');
   
//                     $query="INSERT into statement(userid,month,fees,paid,balance,term,clerk,date,time,year,type,recieptno,recieptdate) VALUES('$id','$mth',$set,$fees,$bal,$tn,'$clerk','$datem','$time',$yer,'new','$no','$dt')";
//                     $stmt=$DB->write($query,[]);
//                     if ($stmt) {
//                         $info->message = "Fess payed Succefully";

//                         $info->type = "pay";
//                         echo json_encode($info);
                        
                       
//                     }else {
//                        $info->message = "Statement not created";
   
//                        $info->type = "err";
//                        echo json_encode($info);
//                     }

//                 }
                
//             }
//         } else {
//             $query=false;
//             $query = "INSERT INTO fees(userid,month,term,fees,paid,balance,year,recieptno,recieptdate) VALUES('$id','$mth',$tn,$set,$fees,$bal,$yer,'$no','$dt') ";
//             $read2 = $DB->write($query,[]);
//             if ($read2) {
                
//                 $query=false;
//                 $clerk='Truphena';
//                 $datem=date('d-m');
//                 $time=date('H:i');

//                 $query="INSERT into statement(userid,month,fees,paid,balance,term,clerk,date,time,year,type,recieptno,recieptdate) VALUES('$id','$mth',$set,$fees,$bal,$tn,'$clerk','$datem','$time',$yer,'new','$no','$dt')";
//                 $stmt=$DB->write($query,[]);
//                 if ($stmt) {
//                     $info->message = "Fess payed Succefully";

//                     $info->type = "pay";
//                     echo json_encode($info);
                
//                 }else {
//                     $info->message = "Statement not created";

//                     $info->type = "err";
//                     echo json_encode($info);
//                 }
                
//             }
            
            
//         }
//     }
// } else {
//     $info->message = "ERROR : Student not nound";

//     $info->type = "pay";
//     echo json_encode($info);
// }
