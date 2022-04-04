<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Pannel</title>

    <!-- Custom fonts for this template-->
    <link href="Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">

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
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class=" col-md-10 col-md-offset-2 ">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3><b>ADD NEW MEMBER</b></h3></div>
                                @if(Session::has('msg'))
                                <div class="panel-heading " ><h4 style="color: green">{{Session::get('msg')}}</h4></div>
                                @endif
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}
                                        
                
                                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-4 control-label">Name</label>
                
                                            <div class="col-md-10">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                
                                            <div class="col-md-10">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                
                                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label for="phone" class="col-md-4 control-label">Phone Number</label>
                
                                            <div class="col-md-10">
                                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required>
                
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                        <strong> {{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                
                                        <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                            <label for="role" class="col-md-4 control-label">Employee Role</label>
                
                                            <div class="col-md-10">
                                                {{-- <input id="role"  class="form-control" name="role" list="rolename" required>
                                                <datalist id="rolename">
                                                  <option value="Manager">
                                                  <option value="Employee">
                                                </datalist> --}}
                                                <select class="form-control" name="role" aria-label="Default select example">
                                                    <option selected>Choose the role</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Employee">Employee</option>
                                                  </select>
                
                                                @if ($errors->has('role'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('role') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('salary') ? ' has-error' : '' }}">
                                            <label for="phone" class="col-md-4 control-label">Annual Salary</label>
                
                                            <div class="col-md-10">
                                                <input id="salary" type="text" class="form-control" name="salary" value="{{ old('salary') }}" required>
                
                                                @if ($errors->has('salary'))
                                                    <span class="help-block">
                                                        <strong> {{ $errors->first('salary') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Password</label>
                
                                            <div class="col-md-10">
                                                <input id="password" type="password" class="form-control" name="password" required>
                
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                
                                            <div class="col-md-10">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="isadmin" value="true" class="custom-control-input" id="customControlAutosizing">
                                            <label class="custom-control-label" for="customControlAutosizing">Make Admin</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary" style="width: 30%">
                                                    Register
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
            <!-- End of Main Content -->

            @include('admin.footer')

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