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
    <title>Document</title>
</head>
<body style="background-color: black; padding-top:5%">

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div style="color: white">{{$error}}</div>
    @endforeach
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success">
        {{session()->get('success')}}
        </div>
        @endif

    <form action="{{url('/posts/update' , $post->id. '/' .$post->image)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="padding-inline: 45%; color:red">
            <h1>Edit Post</h1>
        </div>
        <br>
        <div style="padding-inline: 40%">
        <label style="color: blue" for="">Title:</label>
        <input type="text" value="{{$post->title}}" name="title" placeholder="title">
        </div>
        <br>
        
        <div style="padding-inline: 40%">
        <label style="color: blue" for="">Body:</label>
        <input type="text" value="{{$post->body}}" name="body" placeholder="body">
        </div>
        <br>
        
        <div style="padding-inline: 40%">
        <label style="color: blue" for="">Old Image:</label>
            <td style="color: white; padding:20px;">
                <img style="padding: 20px; height:150px" src="{{asset('productimage/'.$post->image)}}">
            </td>
        </div>

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