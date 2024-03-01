<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
    <style>
       
        .btn-edit {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-edit:hover, .btn-delete:hover {
            filter: brightness(90%);
        }
    </style>
</head>
<body>
    <div class="container">
        <button  style="background-color: lightblue; color: black; text-align:center; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; font-weight: bold; font-size: 20px;">
        <a href="{{route('dashboard')}}">Back to Dashboard</a>
    </button>
        <h1 class="mt-5">URL Shortener</h1>
        @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        
                <form method="post" action="{{ route('generate.tableview.index.post') }} ">
                    @csrf
                    
                    <div class="input-group mb-3 mt-3">
                        <input type="text" name="original_url" class="form-control" placeholder="Enter URL">
                        <div class="input-group-append">
                            <button class="btn btn-success rounded" type="submit">Shorten</button>
                        </div>
                    </div>
                </form>
                <div>
                @error('original_url') 
                <div class="alert alert-danger">{{ $message }}</div> 
                @enderror
             </div>
           
        <table class="table table-bordered mt-5 col-lg-12">
           <thead>
                <tr>
                <th class=" text-center align-middle">ID</th>
        <th class="text-center align-middle">Original URL</th>
        <th class=" text-center align-middle">Short URL</th>
        <th class=" text-center align-middle">Actions</th>
    
                </tr>
           </thead>
           <tbody>
                @foreach($shortUrl as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td class="col-3" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">{{ $row->original_url }}</td>
                    <td><a href="{{ route('tableview.index', $row->shorterned_url) }}" target="_blank">{{ $row->shorterned_url }}</a></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Edit and Delete buttons">
                            <a href="{{ route('tableview.edit', $row->id) }}"><button class="btn btn-edit mr-2 rounded">Edit</button></a>
                            <a href="{{ route('tableview.destroy', $row->id) }}"><button type="submit" class="btn btn-delete rounded">Delete</button></a>
                             
                        </div>
                    </td>
                </tr>
                @endforeach
           </tbody>
        </table>
    </div>
</body>
</html>
