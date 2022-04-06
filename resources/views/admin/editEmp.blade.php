<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Pannel</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;

        }

        form {
            border: 3px solid #f1f1f1;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            height: 70%;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background: #f1f1f2;
        }

        button {
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }


        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body style="background-color: rgb(11, 152, 218)">
    <form id="edit-form" method="post" style="background:#f1f1f1" action='/employee/edit/{{$user->id}}'>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <h2 style="text-align: center;color:blue">Emoployee {{$user->id}} Details!</h2>
        @if(Session::has('message'))
        <div class="panel-heading " style="text-align: center">
            <h4 style="color: green">{{Session::get('message')}}</h4>
        </div>
        @endif
        <div class="container">
            <label><b>Name</b></label>
            <input type="text" name="name" value="{{$user->name}}" required>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span><br>
            @endif

            <label><b>Email</b></label>
            <input type="text" name="email" value="{{$user->email}}" required>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span><br>
            @endif

            <label><b>Phone</b></label>
            <input type="text" name="phone" value="{{$user->phone}}" required>
            @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span><br>
            @endif

            <label><b>Role</b></label>
            <select class="form-control" name="role" aria-label="Default select example">
                <option selected>{{$user->role}}</option>
                <option value="Manager">Manager</option>
                <option value="Employee">Employee</option>
            </select>
            @if ($errors->has('role'))
            <span class="help-block">
                <strong>{{ $errors->first('role') }}</strong>
            </span><br>
            @endif


            <div class="d-grid gap-2">


                <button class="btn btn-success" type="button" onclick="event.preventDefault();
                document.getElementById('edit-form').submit();">Save</button>
                <a href="{{url('/employees')}}" type="button" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>