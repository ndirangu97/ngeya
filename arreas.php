<?php

require_once "./connection.php";

$DB = new Database();
$class =  $_GET['class'];
$stream = $_GET['stream'];

$year = date('Y');

require_once "./dompdf/autoload.inc.php";

// $tdate=date('d-m-Y');

use Dompdf\Dompdf;

$tb="";
// instantiate and use the dompdf class
$dompdf = new Dompdf();


if ($class == 'all' && $stream == 'all') {


    $sql = false;
    $sql = "SELECT * FROM pupils WHERE year=$year";
    $res = $DB->read($sql, []);

    $arraybal = array();
    $arrayfees = array();
    $arraypaid = array();
    if (is_array($res)) {
        $i=0;

        foreach ($res as $key) {
            

            $topay = ($key->term1fees) + ($key->term3fees) + ($key->term3fees);

            array_push($arrayfees, $topay);

            $mbalance = ($key->term1balance) + ($key->term2balance) + ($key->term3balance);
            array_push($arraybal, $mbalance);

            $paid =  ($key->term1paid) + ($key->term2paid) + ($key->term3paid);
            array_push($arraypaid, $paid);


            if ($mbalance>0) {
                $i++;
                $tb.="
                
                <tr>
            <th scope='row'>$i</th>
            <td>$key->name</td>
            <td>$mbalance</td>
            
          </tr>
                ";
            }
        }




        $af = array_sum($arrayfees);
        // echo ('...........................');
        $ap = array_sum($arraypaid);
        // echo ('...........................');
        $ab = array_sum($arraybal);



        $a = "



<!DOCTYPE html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <title>Milimani</title>
  <!-- base:css -->
  <link rel='stylesheet' href='vendors/typicons/typicons.css' />
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
  <script src='./js/bootstrap.min.js'></script>
  <link rel='stylesheet' href='vendors/css/vendor.bundle.base.css' />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel='stylesheet' href='css/vertical-layout-light/style.css' />
  <!-- endinject -->
  <link rel='shortcut icon' href='images/favicon.png' />

  <style>
    .bodyWrapper {
      padding: 0 10px;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      height: 600px;
      width: 100%;
      overflow-y: hidden;
    }
    
  ::-webkit-scrollbar {
    width: 7px;
    height: 10px;
    background: inherit;
  }

  ::-webkit-scrollbar-thumb {
    height: 10px;
    width: 7px;
    background: grey;
    border-radius: 4px;
  }
  .content-table {
    border-collapse: collapse;
    margin: 0;
    font-size: 0.9em;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    font-size: 16px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    min-height: 400px;
  }

  .content-table thead tr {
    background: #b1afaf;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
  }

  .content-table th,
  .content-table td {
    padding: 10px 15px;
    text-align: center;
  }

  .content-table tbody tr {
    border-bottom: 1px solid #f5f5f5  ;
    cursor: pointer;
  }


  .content-table tbody tr:nth-last-of-type(even) {
    background: #f5f5f5;
  }

  .content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  ::-webkit-scrollbar-track {
    background: inherit;
    width: 5px;
    height: 10px;
  }
  </style>
</head>

<body>

  <div class='container-scroller' style='height: 100vh'>
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->

    <div class='container-fluid page-body-wrapper'>

      <!-- partial -->
      <div  style='height:100vh;width:100%;overflow:auto;display:flex;flex-direction:column;align-items:center;padding-top:30px;'>
        <h3>MILIMANI ACCOUNT ARREAS</h3>
        <div style='display:flex;justify-content:center;align-items:center;padding-top:15px'>
          <h4>DATE :</h4> &nbsp; &nbsp;&nbsp;<h5>27TH JUne 2022</h5>
        </div>
        <hr class='w-100'>
        <div class='w-75 '>

          <table class='content-table'>
            <thead>
              <tr>
              <th scope='col'>#</th>
                <th scope='col'>Name</th>
                
                
                <th scope='col'> Balance</th>
              
              </tr>
            </thead>
            <tbody>
              
            
              $tb

            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src='vendors/js/vendor.bundle.base.js'></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src='vendors/chart.js/Chart.min.js'></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src='js/off-canvas.js'></script>
  <script src='js/hoverable-collapse.js'></script>
  <script src='js/template.js'></script>
  <script src='js/settings.js'></script>
  <script src='js/todolist.js'></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src='js/dashboard.js'></script>
  <!-- End custom js for this page-->
</body>

</html>
";



        $dompdf->loadHtml($a);


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("totalactivity.pdf", array("Attachment" => false));


        //     $info->message = array_sum($arraybal);
        //     $info->message = array_sum($arrayfees);

        // $info->type = "pay";
        // echo json_encode($info);
    }else{
        
        $a = "



<!DOCTYPE html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <title>Milimani</title>
  <!-- base:css -->
  <link rel='stylesheet' href='vendors/typicons/typicons.css' />
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
  <script src='./js/bootstrap.min.js'></script>
  <link rel='stylesheet' href='vendors/css/vendor.bundle.base.css' />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel='stylesheet' href='css/vertical-layout-light/style.css' />
  <!-- endinject -->
  <link rel='shortcut icon' href='images/favicon.png' />

  <style>
    .bodyWrapper {
      padding: 0 10px;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      height: 600px;
      width: 100%;
      overflow-y: hidden;
    }
    
  ::-webkit-scrollbar {
    width: 7px;
    height: 10px;
    background: inherit;
  }

  ::-webkit-scrollbar-thumb {
    height: 10px;
    width: 7px;
    background: grey;
    border-radius: 4px;
  }
  .content-table {
    border-collapse: collapse;
    margin: 0;
    font-size: 0.9em;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    font-size: 16px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    min-height: 400px;
  }

  .content-table thead tr {
    background: #b1afaf;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
  }

  .content-table th,
  .content-table td {
    padding: 10px 15px;
    text-align: center;
  }

  .content-table tbody tr {
    border-bottom: 1px solid #f5f5f5  ;
    cursor: pointer;
  }


  .content-table tbody tr:nth-last-of-type(even) {
    background: #f5f5f5;
  }

  .content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  ::-webkit-scrollbar-track {
    background: inherit;
    width: 5px;
    height: 10px;
  }
  </style>
</head>

<body>

  <div class='container-scroller' style='height: 100vh'>
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->

    <div class='container-fluid page-body-wrapper'>

      <!-- partial -->
      <div  style='height:100vh;width:100%;overflow:auto;display:flex;flex-direction:column;align-items:center;padding-top:30px;'>
        <h3>MILIMANI ACCOUNT BALANCES FOR WHOLE SCHOOL</h3>
        <div style='display:flex;justify-content:center;align-items:center;padding-top:15px'>
          <h4>DATE :</h4> &nbsp; &nbsp;&nbsp;<h5>27TH JUne 2022</h5>
        </div>
        <hr class='w-100'>
        <div class='w-75 '>

          <table class='content-table'>
            <thead>
              <tr>
                <th scope='col'>Total Fees</th>
                <th scope='col'>Amount Paid</th>
                <th scope='col'>Total Balance</th>
              
              </tr>
            </thead>
            <tbody>
              
            <tr>
            <th scope='row'>No</th>
            <td>student</td>
            <td>found</td>
            
          </tr>
              

            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src='vendors/js/vendor.bundle.base.js'></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src='vendors/chart.js/Chart.min.js'></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src='js/off-canvas.js'></script>
  <script src='js/hoverable-collapse.js'></script>
  <script src='js/template.js'></script>
  <script src='js/settings.js'></script>
  <script src='js/todolist.js'></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src='js/dashboard.js'></script>
  <!-- End custom js for this page-->
</body>

</html>
";



        $dompdf->loadHtml($a);


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("totalactivity.pdf", array("Attachment" => false));
    }
} elseif ($class != 'all' && $stream == 'all') {


    $sql = false;
    $sql = "SELECT * FROM pupils WHERE year=$year and class =$class";
    $res = $DB->read($sql, []);

    $arraybal = array();
    $arrayfees = array();
    $arraypaid = array();
    if (is_array($res)) {

        foreach ($res as $key) {

            $topay = ($key->term1fees) + ($key->term3fees) + ($key->term3fees);

            array_push($arrayfees, $topay);

            $mbalance = ($key->term1balance) + ($key->term2balance) + ($key->term3balance);
            array_push($arraybal, $mbalance);

            $paid =  ($key->term1paid) + ($key->term2paid) + ($key->term3paid);
            array_push($arraypaid, $paid);
            if ($mbalance>0) {
                $i++;
                $tb.="
                
                <tr>
            <th scope='row'>$i</th>
            <td>$key->name</td>
            <td>$mbalance</td>
            
          </tr>
                ";
            }else{
                $tb.="
                <th scope='row'>i</th>
                <td>key->name</td>
                <td>mbalance</td>
                ";
            }
        }




        $af = array_sum($arrayfees);
        // echo ('...........................');
        $ap = array_sum($arraypaid);
        // echo ('...........................');
        $ab = array_sum($arraybal);



        $a = "



<!DOCTYPE html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <title>Milimani</title>
  <!-- base:css -->
  <link rel='stylesheet' href='vendors/typicons/typicons.css' />
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
  <script src='./js/bootstrap.min.js'></script>
  <link rel='stylesheet' href='vendors/css/vendor.bundle.base.css' />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel='stylesheet' href='css/vertical-layout-light/style.css' />
  <!-- endinject -->
  <link rel='shortcut icon' href='images/favicon.png' />

  <style>
    .bodyWrapper {
      padding: 0 10px;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      height: 600px;
      width: 100%;
      overflow-y: hidden;
    }
    
  ::-webkit-scrollbar {
    width: 7px;
    height: 10px;
    background: inherit;
  }

  ::-webkit-scrollbar-thumb {
    height: 10px;
    width: 7px;
    background: grey;
    border-radius: 4px;
  }
  .content-table {
    border-collapse: collapse;
    margin: 0;
    font-size: 0.9em;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    font-size: 16px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    min-height: 400px;
  }

  .content-table thead tr {
    background: #b1afaf;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
  }

  .content-table th,
  .content-table td {
    padding: 10px 15px;
    text-align: center;
  }

  .content-table tbody tr {
    border-bottom: 1px solid #f5f5f5  ;
    cursor: pointer;
  }


  .content-table tbody tr:nth-last-of-type(even) {
    background: #f5f5f5;
  }

  .content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  ::-webkit-scrollbar-track {
    background: inherit;
    width: 5px;
    height: 10px;
  }
  </style>
</head>

<body>

  <div class='container-scroller' style='height: 100vh'>
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->

    <div class='container-fluid page-body-wrapper'>

      <!-- partial -->
      <div  style='height:100vh;width:100%;overflow:auto;display:flex;flex-direction:column;align-items:center;padding-top:30px;'>
        <h3>MILIMANI ACCOUNT BALANCES FOR CLASS </h3>
        <div style='display:flex;justify-content:center;align-items:center;padding-top:15px'>
          <h4>DATE :</h4> &nbsp; &nbsp;&nbsp;<h5>27TH JUne 2022</h5>
        </div>
        <hr class='w-100'>
        <div class='w-75 '>

          htt
        </div>
      </div>

    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src='vendors/js/vendor.bundle.base.js'></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src='vendors/chart.js/Chart.min.js'></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src='js/off-canvas.js'></script>
  <script src='js/hoverable-collapse.js'></script>
  <script src='js/template.js'></script>
  <script src='js/settings.js'></script>
  <script src='js/todolist.js'></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src='js/dashboard.js'></script>
  <!-- End custom js for this page-->
</body>

</html>
";



        $dompdf->loadHtml('<h1>mm</h1>');


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("totalactivity.pdf");


        //     $info->message = array_sum($arraybal);
        //     $info->message = array_sum($arrayfees);

        // $info->type = "pay";
        // echo json_encode($info);
    }else{
        
        $a = "



<!DOCTYPE html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <title>Milimani</title>
  <!-- base:css -->
  <link rel='stylesheet' href='vendors/typicons/typicons.css' />
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
  <script src='./js/bootstrap.min.js'></script>
  <link rel='stylesheet' href='vendors/css/vendor.bundle.base.css' />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel='stylesheet' href='css/vertical-layout-light/style.css' />
  <!-- endinject -->
  <link rel='shortcut icon' href='images/favicon.png' />

  <style>
    .bodyWrapper {
      padding: 0 10px;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      height: 600px;
      width: 100%;
      overflow-y: hidden;
    }
    
  ::-webkit-scrollbar {
    width: 7px;
    height: 10px;
    background: inherit;
  }

  ::-webkit-scrollbar-thumb {
    height: 10px;
    width: 7px;
    background: grey;
    border-radius: 4px;
  }
  .content-table {
    border-collapse: collapse;
    margin: 0;
    font-size: 0.9em;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    font-size: 16px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    min-height: 400px;
  }

  .content-table thead tr {
    background: #b1afaf;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
  }

  .content-table th,
  .content-table td {
    padding: 10px 15px;
    text-align: center;
  }

  .content-table tbody tr {
    border-bottom: 1px solid #f5f5f5  ;
    cursor: pointer;
  }


  .content-table tbody tr:nth-last-of-type(even) {
    background: #f5f5f5;
  }

  .content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  ::-webkit-scrollbar-track {
    background: inherit;
    width: 5px;
    height: 10px;
  }
  </style>
</head>

<body>

  <div class='container-scroller' style='height: 100vh'>
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->

    <div class='container-fluid page-body-wrapper'>

      <!-- partial -->
      <div  style='height:100vh;width:100%;overflow:auto;display:flex;flex-direction:column;align-items:center;padding-top:30px;'>
        <h3>MILIMANI ACCOUNT BALANCES FOR WHOLE SCHOOL</h3>
        <div style='display:flex;justify-content:center;align-items:center;padding-top:15px'>
          <h4>DATE :</h4> &nbsp; &nbsp;&nbsp;<h5>27TH JUne 2022</h5>
        </div>
        <hr class='w-100'>
        <div class='w-75 '>

          <table class='content-table'>
            <thead>
              <tr>
                <th scope='col'>Total Fees</th>
                <th scope='col'>Amount Paid</th>
                <th scope='col'>Total Balance</th>
              
              </tr>
            </thead>
            <tbody>
              
            <tr>
            <th scope='row'>No</th>
            <td>student</td>
            <td>found</td>
            
          </tr>
              

            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src='vendors/js/vendor.bundle.base.js'></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src='vendors/chart.js/Chart.min.js'></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src='js/off-canvas.js'></script>
  <script src='js/hoverable-collapse.js'></script>
  <script src='js/template.js'></script>
  <script src='js/settings.js'></script>
  <script src='js/todolist.js'></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src='js/dashboard.js'></script>
  <!-- End custom js for this page-->
</body>

</html>
";



        $dompdf->loadHtml($a);


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("totalactivity.pdf", array("Attachment" => false));
    }
} else {



    $sql = false;
    $sql = "SELECT * FROM pupils WHERE year=$year and class =$class and stream='$stream'";
    $res = $DB->read($sql, []);

    $arraybal = array();
    $arrayfees = array();
    $arraypaid = array();
    if (is_array($res)) {

        foreach ($res as $key) {

            $topay = ($key->term1fees) + ($key->term3fees) + ($key->term3fees);

            array_push($arrayfees, $topay);

            $mbalance = ($key->term1balance) + ($key->term2balance) + ($key->term3balance);
            array_push($arraybal, $mbalance);

            $paid =  ($key->term1paid) + ($key->term2paid) + ($key->term3paid);
            array_push($arraypaid, $paid);

            if ($mbalance>0) {
                $i++;
                $tb.="
                
                <tr>
            <th scope='row'>$i</th>
            <td>$key->name</td>
            <td>$mbalance</td>
            
          </tr>
                ";
            }
        }




        $af = array_sum($arrayfees);
        // echo ('...........................');
        $ap = array_sum($arraypaid);
        // echo ('...........................');
        $ab = array_sum($arraybal);



        $a = "



<!DOCTYPE html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <title>Milimani</title>
  <!-- base:css -->
  <link rel='stylesheet' href='vendors/typicons/typicons.css' />
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
  <script src='./js/bootstrap.min.js'></script>
  <link rel='stylesheet' href='vendors/css/vendor.bundle.base.css' />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel='stylesheet' href='css/vertical-layout-light/style.css' />
  <!-- endinject -->
  <link rel='shortcut icon' href='images/favicon.png' />

  <style>
    .bodyWrapper {
      padding: 0 10px;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      height: 600px;
      width: 100%;
      overflow-y: hidden;
    }
    
  ::-webkit-scrollbar {
    width: 7px;
    height: 10px;
    background: inherit;
  }

  ::-webkit-scrollbar-thumb {
    height: 10px;
    width: 7px;
    background: grey;
    border-radius: 4px;
  }
  .content-table {
    border-collapse: collapse;
    margin: 0;
    font-size: 0.9em;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    font-size: 16px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    min-height: 400px;
  }

  .content-table thead tr {
    background: #b1afaf;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
  }

  .content-table th,
  .content-table td {
    padding: 10px 15px;
    text-align: center;
  }

  .content-table tbody tr {
    border-bottom: 1px solid #f5f5f5  ;
    cursor: pointer;
  }


  .content-table tbody tr:nth-last-of-type(even) {
    background: #f5f5f5;
  }

  .content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  ::-webkit-scrollbar-track {
    background: inherit;
    width: 5px;
    height: 10px;
  }
  </style>
</head>

<body>

  <div class='container-scroller' style='height: 100vh'>
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->

    <div class='container-fluid page-body-wrapper'>

      <!-- partial -->
      <div  style='height:100vh;width:100%;overflow:auto;display:flex;flex-direction:column;align-items:center;padding-top:30px;'>
        <h3>MILIMANI ACCOUNT BALANCES FOR CLASS $class STREAM $stream</h3>
        <div style='display:flex;justify-content:center;align-items:center;padding-top:15px'>
          <h4>DATE :</h4> &nbsp; &nbsp;&nbsp;<h5>27TH JUne 2022</h5>
        </div>
        <hr class='w-100'>
        <div class='w-75 '>

          <table class='content-table'>
            <thead>
              <tr>
                <th scope='col'>Total Fees</th>
                <th scope='col'>Amount Paid</th>
                <th scope='col'>Total Balance</th>
              
              </tr>
            </thead>
            <tbody>
              
            <tr>
            $tb
            
          </tr>
              

            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src='vendors/js/vendor.bundle.base.js'></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src='vendors/chart.js/Chart.min.js'></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src='js/off-canvas.js'></script>
  <script src='js/hoverable-collapse.js'></script>
  <script src='js/template.js'></script>
  <script src='js/settings.js'></script>
  <script src='js/todolist.js'></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src='js/dashboard.js'></script>
  <!-- End custom js for this page-->
</body>

</html>
";



        $dompdf->loadHtml($a);


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("totalactivity.pdf", array("Attachment" => false));



        //     $info->message = array_sum($arraybal);
        //     $info->message = array_sum($arrayfees);

        // $info->type = "pay";
        // echo json_encode($info);
    }
    else{
        
        $a = "



<!DOCTYPE html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <title>Milimani</title>
  <!-- base:css -->
  <link rel='stylesheet' href='vendors/typicons/typicons.css' />
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
  <script src='./js/bootstrap.min.js'></script>
  <link rel='stylesheet' href='vendors/css/vendor.bundle.base.css' />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel='stylesheet' href='css/vertical-layout-light/style.css' />
  <!-- endinject -->
  <link rel='shortcut icon' href='images/favicon.png' />

  <style>
    .bodyWrapper {
      padding: 0 10px;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      height: 600px;
      width: 100%;
      overflow-y: hidden;
    }
    
  ::-webkit-scrollbar {
    width: 7px;
    height: 10px;
    background: inherit;
  }

  ::-webkit-scrollbar-thumb {
    height: 10px;
    width: 7px;
    background: grey;
    border-radius: 4px;
  }
  .content-table {
    border-collapse: collapse;
    margin: 0;
    font-size: 0.9em;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    font-size: 16px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    min-height: 400px;
  }

  .content-table thead tr {
    background: #b1afaf;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
  }

  .content-table th,
  .content-table td {
    padding: 10px 15px;
    text-align: center;
  }

  .content-table tbody tr {
    border-bottom: 1px solid #f5f5f5  ;
    cursor: pointer;
  }


  .content-table tbody tr:nth-last-of-type(even) {
    background: #f5f5f5;
  }

  .content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  ::-webkit-scrollbar-track {
    background: inherit;
    width: 5px;
    height: 10px;
  }
  </style>
</head>

<body>

  <div class='container-scroller' style='height: 100vh'>
    <!-- partial:partials/_navbar.html -->

    <!-- partial -->

    <div class='container-fluid page-body-wrapper'>

      <!-- partial -->
      <div  style='height:100vh;width:100%;overflow:auto;display:flex;flex-direction:column;align-items:center;padding-top:30px;'>
        <h3>MILIMANI ACCOUNT BALANCES FOR WHOLE SCHOOL</h3>
        <div style='display:flex;justify-content:center;align-items:center;padding-top:15px'>
          <h4>DATE :</h4> &nbsp; &nbsp;&nbsp;<h5>27TH JUne 2022</h5>
        </div>
        <hr class='w-100'>
        <div class='w-75 '>

          <table class='content-table'>
            <thead>
              <tr>
                <th scope='col'>Total Fees</th>
                <th scope='col'>Amount Paid</th>
                <th scope='col'>Total Balance</th>
              
              </tr>
            </thead>
            <tbody>
              
            <tr>
            <th scope='row'>No</th>
            <td>student</td>
            <td>found</td>
            
          </tr>
              

            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src='vendors/js/vendor.bundle.base.js'></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src='vendors/chart.js/Chart.min.js'></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src='js/off-canvas.js'></script>
  <script src='js/hoverable-collapse.js'></script>
  <script src='js/template.js'></script>
  <script src='js/settings.js'></script>
  <script src='js/todolist.js'></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src='js/dashboard.js'></script>
  <!-- End custom js for this page-->
</body>

</html>
";



        $dompdf->loadHtml($a);


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("totalactivity.pdf", array("Attachment" => false));
    }
}
