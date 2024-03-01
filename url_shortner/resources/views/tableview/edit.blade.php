<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
</head>
<body>
<div class="container">
    <h2>Edit URL</h2>
    <form action="{{ route('tableview.update',$shortUrl->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="original_url">Original URL</label>
            <input type="text" name="original_url" class="form-control" value="{{ $shortUrl->original_url }}">
            @error('original_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>