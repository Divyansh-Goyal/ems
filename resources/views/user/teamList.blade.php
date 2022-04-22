<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Pannel</title>
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

        @include('user.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            @include('user.topbar')
            <!-- Main Content -->
            <div id="content">

                <table id="teamListTable" class="table table-striped">
                    <div class="table-title">
                        <div class="row">

                            <div class="col-xs-6">
                                <h2><b>{{Auth::user()->name}} Team Members</b></h2>
                            </div>
                            @if(Session::has('msg'))
                            <div class="panel-heading">
                                <p style="color: crimson">{{Session::get('msg')}}</p>
                            </div>
                            @endif
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
                            <th scope="col">Joining Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td scope="row">{{$user->id}}</td>
                            <td scope="row">{{$user->name}}</td>
                            <td scope="row">Date: {{$user->created_at->format('d-m')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="padding-left: 2%">
                    <a href="#" title="request" type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#addModal">Add Member</a>
                </div>
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="exampleModalLabel">Add Team Member By Id</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <form id="add-form" action="/teamMember/add" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                            </div>
                            <div class="modal-body">

                                <div class="form-group {{ $errors->has('emp_id') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-4 control-label">Employee Code</label>
                                    <div class="col-md-10">
                                        <input id="emp_id" type="text" class="form-control" name="emp_id"
                                            value="{{ old('emp_id') }}" required>

                                        @if ($errors->has('emp_id'))
                                        <span class="help-block">
                                            <strong> {{ $errors->first('emp_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-success" onclick="event.preventDefault();
                                    document.getElementById('add-form').submit();">
                                    Add New
                                </a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End of Main Content -->

            @include('user.footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    @if ($errors->first('emp_id'))
    <script>
        $('#addModal').modal('show');
    </script>
    @endif
    <script>
        $(document).ready(function(){
            var table = $('#teamListTable').DataTable({
                "language": {
                    "emptyTable": "Currently You Have No Team Members"
                }  
            }); 
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