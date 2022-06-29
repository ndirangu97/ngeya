<?php

// die;

$m = $DATA_OBJECT->term;
$y = $DATA_OBJECT->year;
$fees = $DATA_OBJECT->fees;
$cl = $DATA_OBJECT->class;
$err = "";

$sql = false;
$sql = "SELECT * FROM pupils WHERE class=$cl and year=$y";
$res = $DB->read($sql, []);
if (is_array($res)) {
    if ($m == '1') {
        foreach ($res as $row) {

            if (($row->term1fees) != 0) {
                $err = "ERROR : Votehead for Term $m Class   $cl have already been set";
            }
        }
    }
    if ($m == '2') {
        foreach ($res as $row) {


            if (($row->term2fees) != 0) {
                $err = "ERROR : Votehead for Term $m Class   $cl have already been set";
            }
        }
    }
    if ($m == '3') {
        foreach ($res as $row) {

            if (($row->term3fees) != 0) {
                $err = "ERROR : Votehead for Term $m Class   $cl have already been set";
            }
        }
    }


    if ($err == "") {
        if ($m == '1') {

            $query = false;
            $query = "UPDATE  pupils SET term1fees=$fees,term1balance=$fees  WHERE class=$cl  and year=$y";
            $write = $DB->write($query, []);

            if ($write) {
                

                $info->message = "Fees  set for Class  $cl Term $m successfully as $fees";

                $info->type = "set";
                echo json_encode($info);
            } else {
                $err = 'error occurred';
            }
        } elseif ($m == '2') {
            $query = false;
            $query = "UPDATE  pupils SET term2fees=$fees,term2balance=$fees WHERE class=$cl and year=$y ";
            $write = $DB->write($query, []);

            if ($write) {


                $info->message = "Fees  set for Class  $cl Term $m successfully as $fees";

                $info->type = "set";
                echo json_encode($info);
            } else {
                $err = 'error occurred';
            }
        } elseif ($m == '3') {
            $query = false;
            $query = "UPDATE  pupils SET term3fees=$fees,term3balance=$fees WHERE class=$cl  and year=$y";
            $write = $DB->write($query, []);

            if ($write) {


                $info->message = "Fees  set for Class  $cl  Term $m successfully as $fees";

                $info->type = "set";
                echo json_encode($info);
            } else {
                $err = 'error occurred';
            }
        }
    }
} else {
    $err = "ERROR : No such class or year in database";
}
if ($err != "") {

    $info->message = $err;

    $info->type = "err";
    echo json_encode($info);
}
