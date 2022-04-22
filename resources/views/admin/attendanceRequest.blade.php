<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Pannel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            @include('admin.topbar')
            <!-- Main Content -->
            <div id="content">

                <table id="attendanceTable" class="table table-striped">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h2><b>Employees Attendance Requests</b></h2>
                            </div>
                        </div>
                        @if(Session::has('message'))
                        <div class="panel-heading " style="text-align: center">
                            <h4 style="color: green">{{Session::get('message')}}</h4>
                        </div>
                        @endif
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Shift Hours</th>
                            <th scope="col">Accept/Reject</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_att as $user)
                        <tr>
                            <td scope="row">{{$user->user_id}}</td>
                            <td scope="row">{{$user->user->name}}</td>
                            <td scope="row">Date: {{$user->created_at->format('d-m')}}</td>
                            <td scope="row">{{$user->shift_time}} Hours</td>
                            <td scope="row">
                                <a href="/requestPending/rejected/{{$user->id}}" type="button" title="request"
                                    class="btn btn-danger">Reject</a>
                                <a href="/requestPending/approved/{{$user->id}}" title="request" type="button"
                                    class="btn btn-success">Approve</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <!-- End of Main Content -->

            @include('admin.footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <script>
        $(document).ready(function(){
            var table = $('#attendanceTable').DataTable();
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"
        defer></script>

    <!-- Bootstrap core JavaScript-->
    <script src="Admin/vendor/jquery/jquery.min.js"></script>
    <script src="Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="Admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="Admin/js/sb-admin-2.min.js"></script>


</body>

</html>