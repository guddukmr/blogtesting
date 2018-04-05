@include('header')
<html>
<body>
    <h2>session </h2>
    <form method="POST" action="session4">
        {{ csrf_field() }}
        
 <div class="form-group">
            <label for="mobile">Mobile Number:</label>
            <input type="number" class="form-control" id="mob" name="mob" required>
        </div>


        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
       
    </form>
  
</body>
</html>