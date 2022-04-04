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
                 <div style="text-align: center">
                    <h2 class="fw-bold" >Salary Details</h2>
                 </div>
                
                <div class="container mt-5 mb-5">
                    <?php $salary = Auth::user()->salary->salary ?>
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="d-flex justify-content-end"> <span>Employee Role:Currently {{Auth::User()->role}}</span> </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div> <span class="fw-bolder">EMP Code :</span> <small class="ms-3">{{Auth::User()->id}}</small> </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div> <span class="fw-bolder">Joining Date :</span> <small class="ms-3">{{Auth::User()->created_at->format('Y-m-d')}}</small> </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div> <span class="fw-bolder">EMP Name :</span> <small class="ms-3">{{Auth::User()->name}}</small> </div>
                                        </div>
                                    </div> 
                                </div>
                                <table class="mt-4 table table-bordered">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th scope="col">Earnings</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Employee Contribution</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Basic</th>
                                            <td>{{number_format(($salary/12 - ($salary/12)*0.1)/2,2)}}</td>
                                            <td>PF</td>
                                            <td>{{number_format(($salary*0.03/12),2)}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Special Allowance</th>
                                            <td>{{number_format(($salary/12 - ($salary/12)*0.1)/4,2)}}</td>
                                            <td>LWF</td>
                                            <td>{{number_format(($salary*0.005/12 ),2)}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">HRA</th>
                                            <td>{{number_format(($salary/12 - ($salary/12)*0.1)/4,2)}}</td>
                                            <td>TDS</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Monthly Gross Income</th>
                                            <td><b>{{number_format(($salary/12 - ($salary/12)*0.1),2)}}</b></td>
                                            <td>EWF</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Variable Salary (up To)</th>
                                            <td>{{number_format(($salary*0.03/12 ),2)}}</td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Gratuity</th>
                                            <td>{{number_format(($salary*0.01/12 ),2)}}</td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bonus</th>
                                            <td>{{number_format(($salary*0.025/12 ),2)}}</td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr class="border-top">
                                            <th scope="row">Total Compensation(CTC)</th>
                                            <td></td>
                                            <td> </td>
                                            <td>{{number_format($salary,2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
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


