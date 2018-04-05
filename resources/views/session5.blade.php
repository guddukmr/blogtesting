@include('header')
<html>
<body>
    <h2>session </h2>
    <form method="POST" action="session6" enctype="multipart/form-data">
        {{ csrf_field() }}
        
 <div class="form-group">
            <label for="pine">Upload your picture:</label>
            
            <input type="file" class="form-control" name="image"  required>
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
       
    </form>
  
</body>
</html>

