<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            label
     {
         display: inline-block;
         width: 100px;
         font-size: 15px;
         font-weight: bold;
        }
        </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Post</title>
</head>
<body style="background-color: black; padding-top:5%">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @if(session()->has('success'))
        <div class="alert alert-success">
        {{session()->get('success')}}
        </div>
        @endif

    <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="padding-inline: 45%; color:red">
            <h1>Add Post</h1>
        </div>
        <br>
        <div style="padding-inline: 40%">
        <label style="color: blue" for="">Title:</label>
        <input type="text" name="title" value="{{old('title')}}" placeholder="title">
        </div>
        <br>
        
        <div style="padding-inline: 40%">
        <label style="color: blue" for="">Body:</label>
        <input type="text" name="body" value="{{old('body')}}" placeholder="body">
        </div>
        <br>
        
        <div style="padding-inline: 40%">
        <label style="color: blue" for="">Image:</label><hr>
        <input type="file" name="image"><hr>
        </div>
        <br>
        
        <div style="padding-inline: 40%">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>
</html>