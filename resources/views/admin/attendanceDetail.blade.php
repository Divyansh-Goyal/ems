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
        <form action="" method="GET">
          <div class="row" style="width: 55%">
            <div class="col">
              <input type="date" class="form-control" id="appt" name="from" value="{{$from}}">
            </div>
            <div class="col">
              <input type="date" class="form-control" id="appt" name="to" value="{{$to}}">
            </div>
            <div class="col">
              <button class="btn btn-primary">Apply</button>
            </div>
          </div>
        </form>


        <table class="table table-striped" id="myTable">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-8">
                <h2><b>Employees Attendance</b></h2>
              </div>
              <div class="col-sm-3">
                <div class="search-box">

                  <input type="text" class="form-control" placeholder="Search&hellip;" id="myInput"
                    onkeyup="myFunction()">

                </div>
              </div>
            </div>

          </div>
      </div>
      <thead>
        <tr>
          <th scope="col">Employee ID</th>
          <th scope="col">Name</th>
          <th scope="col">Request Pending</th>
          <th scope="col">Total absent</th>
          <th scope="col">Total present</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($user_att as $user)
        <tr>
          <td scope="row">{{$user->user_id}}</td>
          <td scope="row">{{$user->user->name}}</td>
          <td scope="row">{{$user->Request}}</td>
          <td scope="row">{{$user->Absent}}</td>
          <td scope="row">{{$user->Present}}</td>
        </tr>
        @endforeach

      </tbody>
      </table>

    </div>
    <nav aria-label="...">
      <ul class="pagination" style="float: right;margin: 0 0 10px;">
        @if($user_att->previousPageUrl())
        <li class="page-item ">
          <a class="page-link" href="{{$user_att->previousPageUrl()}}">
            << </a>
        </li>&nbsp;
        @endif
        <li class="page-item">
          <h6 class="page-link" style="color: black">{{$user_att->currentPage()}}</h6>
        </li>&nbsp;
        @if($user_att->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{$user_att->nextPageUrl()}}">>></a>
        </li>
        @endif
      </ul>
    </nav>

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
  <script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
      
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
  </script>
</body>

</html>