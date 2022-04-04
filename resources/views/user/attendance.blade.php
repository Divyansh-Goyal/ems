<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Pannel</title>

    <!-- Custom fonts for this template-->
    <link href="Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    
    <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('user.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            @include('user.topbar')
            <!-- Main Content -->
             <div id="content">
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class=" col-md-10 col-md-offset-2 ">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h2>Todays Attendance<b> {{date("j F Y")}}</b></h2></div>
                                @if(Session::has('msg'))
                                <div class="panel-heading"><h3 style="color: crimson">{{Session::get('msg')}}</h3></div>
                                @endif
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="/attendance/update">
                                        {{ csrf_field() }}
                                        <div class="form-group ">
                                            <label for="name" class="col-md-4 control-label">Name</label>
                
                                            <div class="col-md-10">
                                                <input id="name" type="text" class="form-control" name="name" value="Attendance Request" required readonly>
            
                                            </div>
                                        </div>
                
                
                                        <div class="row">
                                            <div class="col">
                                              <label for="inTime" class="col-md-4 control-label">In Time</label>
                                              <input type="time" class="form-control" id="appt" name="in" value="{{date('H:m')}}">
                                            </div>
                                            <div class="col">
                                              <label for="inTime" class="col-md-4 control-label">Exit Time</label>
                                              <input type="time" class="form-control" id="appt" name="out" value="{{date('H:m')}}">
                                            </div>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-4">
                                                <button type="submit" class="btn btn-success" style="width: 30%">
                                                    Send Request
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            <!--End Main Content -->
            @include('user.footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    
    
    <!-- Bootstrap core JavaScript-->
    <script src="Admin/vendor/jquery/jquery.min.js"></script>
    <script src="Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="Admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="Admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="Admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="Admin/js/demo/chart-area-demo.js"></script>
    <script src="Admin/js/demo/chart-pie-demo.js"></script>

</body>

</html>


