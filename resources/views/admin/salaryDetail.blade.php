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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
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
                
                <table id="salaryTable" class="table table-striped">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h2>&nbsp; Manage <b>Employees Salary</b></h2>
                            </div>
                        </div>
                    </div>
                    <thead>
                      <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Annual Salary</th>
                        <th scope="col">Joining Date</th>
                        <th scope="col">Role</th>
                        <th scope="col">Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td scope="row" >{{$user->id}}</td>
                        <td scope="row"  >{{$user->name}}</td>
                        <td scope="row" >{{$user->salary->salary}}</td> 
                        <td scope="row" >{{$user->created_at->format('Y-m-d')}}</td>  
                        <td scope="row" >{{$user->role}}</td>
                        <td scope="row">
                            <a  type="button" class="edit" title="Edit"  ><i class="material-icons">&#xE254;</i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
            </div>
            {{-- <nav aria-label="...">
                <ul class="pagination" style="float: right;margin: 0 0 10px;">
                  @if($users->previousPageUrl())
                  <li class="page-item ">
                    <a class="page-link" href="{{$users->previousPageUrl()}}"><<</a>
                  </li>&nbsp;
                  @endif
                  <li class="page-item"><h6 class="page-link" style="color: black" >{{$users->currentPage()}}</h6></li>&nbsp;
                  @if($users->hasMorePages())
                  <li class="page-item">
                    <a class="page-link" href="{{$users->nextPageUrl()}}">>></a>
                  </li>
                  @endif
                </ul>
              </nav> --}}
                  
            <!-- End of Main Content -->

            @include('admin.footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>Edit Salary</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="edit-form" class="form-horizontal" method="POST" action="/salary/edit">
                    {{ csrf_field() }}
                    {{ method_field('PATCH')}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label"><b>Name</b></label>

                    <div class="col-md-10">
                        <input  type="text" id="fname" class="form-control" name="name" value="" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label"><b>Annual Salary</b></label>

                    <div class="col-md-10">
                        <input id="salary" type="text" class="form-control" name="salary" value="" required>

                        @if ($errors->has('salary'))
                            <span class="help-block">
                                <strong>{{ $errors->first('salary') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="event.preventDefault();
              document.getElementById('edit-form').submit();" >Save changes</button>
            </div>
          </div>
        </div>
      </div>

    
    <script>
        $(document).ready(function(){
            var table = $('#salaryTable').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                // console.log(data);
                $('#fname').val(data[1]);
                $('#salary').val(data[2]);
                $('#role').val(data[4]);
                $('#edit-form').attr('action','/salary/edit/'+data[0]);
                $('#exampleModal').modal('show');
            })
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script> 
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>

    <!-- Bootstrap core JavaScript-->
    <script src="Admin/vendor/jquery/jquery.min.js"></script>
    <script src="Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="Admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="Admin/js/sb-admin-2.min.js"></script>


</body>

</html>