<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Posts</title>
</head>
<body style="background-color: black">
    <div style="padding-inline: 40%; padding-top:5%">
        @if(session()->has('success'))
            <div class="alert alert-success">
            {{session()->get('success')}}
            </div>
            @endif
        <table border="5" style="color: white">
            <tr align="center" style="color: blue">
            <td style="padding: 20px;">#</td>
            <td style="padding: 20px;">Title</td>
            <td style="padding: 20px;">Body</td>
            <td style="padding: 20px;">Edit</td>
            <td style="padding: 20px;">Restore</td>
        </tr>
        <?php $i=0 ?>
        @foreach($posts as $post)
        <?php $i++ ?>
        <tr align="center">
            <td style="color:red; padding:20px;">{{$i}}</td>
            <td style="padding: 20px;">{{$post->title}}</td>
            <td style="padding: 20px;">{{$post->body}}</td>
            <td style="padding: 20px;">
                <a class="btn btn-primary" href="{{route('edit' , $post->id)}}">Edit</a>
            </td>
            <td style="padding: 20px;">
                <a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-success" href="{{route('restorePost' , $post->id)}}">Restore</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>