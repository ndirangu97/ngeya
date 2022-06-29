<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Milimani</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />

    <style>
        .bodyWrapper {
            padding: 0 10px;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            height: 540px;
            width: 100%;
            overflow-y: hidden;
        }
    </style>
</head>

<body>

    <div class="container-scroller" style="height: 100vh">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="height: 78px">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="
              navbar-brand-inner-wrapper
              d-flex
              justify-content-between
              align-items-center
              w-100
            ">
          <a class="navbar-brand brand-logo" href="index.php"><img src="./images/milimani.jpg" alt="logo" style="object-fit: cover; width: 50px; height: 50px" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo-mini.svg" alt="logo" /></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </div>
      <div class="
            navbar-menu-wrapper
            d-flex
            align-items-center
            justify-content-end
          ">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face5.jpg" alt="profile" />
              <span class="nav-profile-name">Truphena</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" onclick="location='login.php'">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-date dropdown">
            <a class="
                  nav-link
                  d-flex
                  justify-content-center
                  align-items-center
                " href="javascript:;">
              <!-- <h6 class="date mb-0"><?php echo date("Y"); ?></h6> -->
              <i class="typcn typcn-calendar"></i>
            </a>
          </li>
          <li class="nav-item nav-profile dropdown">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search pupil..." aria-label="search" aria-describedby="search" style="width: 400px" oninput='pupilName(event)' />
              <div class="input-group-prepend" style="cursor: pointer">
                <span class="input-group-text" id="search">
                  <i class="typcn typcn-zoom"></i>
                </span>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="
                  nav-link
                  count-indicator
                  dropdown-toggle
                  d-flex
                  justify-content-center
                  align-items-center
                " id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="typcn typcn-cog-outline mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
             
              <a class="dropdown-item" onclick="location='login.php'">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="
              navbar-toggler navbar-toggler-right
              d-lg-none
              align-self-center
            " type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <?php include './nav.view.php'; ?>
            <!-- partial -->
            <div class="bodyWrapper">

                <div  style="width: 80%;height:200px;display: flex;justify-content: space-around;
      align-items: center; flex-direction: row;">
                    <div class='card' style="flex-basis: 45%;height: 100%;display: flex;justify-content: space-around;
      align-items: center; flex-direction: column;">
                        <h5>Download Today's Activity</h5>
                        <button onclick="printact()" style="padding: 2px 20px;border:1px solid #009879;border-radius:8px;cursor:pointer;background:#7ed2f3">
                        Download</button>
                    </div>
                    <div  class='card'style="flex-basis: 45%;height: 100%;display: flex;justify-content: space-around;
      align-items: center; flex-direction: column;">
                        <h5>Download Activity</h5>
                        <div style="display: flex;justify-content: space-between;
      align-items: center; flex-direction: row;">
                            <input id="act" style="border:1px solid #009879;border-radius:4px;height:30px;width:150px;" type="date" name="" id="">
                        <button  onclick="pallact()"  style="padding: 2px 20px;border:1px solid #009879;border-radius:8px;cursor:pointer;background:#7ed2f3;margin-left:30px">Download</button>
                        </div>
                    </div>
                </div>
                

            </div>

        </div>

        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
<script>
    const sendData = (data, type) => {
        let b = document.getElementById('gif')
        b.style.display = 'block'
        let ib = document.getElementById('imbtn')
        ib.disabled = true
        let iy = document.getElementById('ybtn')
        iy.disabled = true

        var xml = new XMLHttpRequest()

        xml.onload = function() {

            if (xml.readyState == 4 || xml.status == 200) {

                handleResult(xml.responseText)
                let b = document.getElementById('gif')
                b.style.display = 'none'
                ib.disabled = false
                let iy = document.getElementById('ybtn')
                iy.disabled = false

            }
        }

        data.type = type
        var dataString = JSON.stringify(data)
        xml.open("POST", "./routes.php", true)
        xml.send(dataString)
    }
    const handleResult = (results) => {
        // alert(results)
        var info = JSON.parse(results);

        switch (info.type) {

            case 'err':
                let ime = document.getElementById('imerr');
                ime.innerHTML = info.message

                break;
            case 'import':
                let im = document.getElementById('imerr');
                im.innerHTML = info.message

                break;
            case 'yearly':

                let imy = document.getElementById('imerr');
                imy.innerHTML = info.message

                break;




            default:
                break;
        }

    }

    function trans() {
        let c = confirm('Are you sure you want to yearly transferr to next class?')

        if (c) {
            sendData({}, 'yearly')
        }
    }

    function getport() {
        let c = confirm('Are you sure you want to import students?')

        if (c) {
            sendData({}, 'import')
        }
    }
    function printact() {
        window.open('download.php')
    }

    function pallact() {
        let t= document.getElementById('act').value
      if (t=="") {
        alert('Date cant be empty')

      }else{
          window.open(`allactivity.php?date=${t}`)
      }
     
    }
</script>