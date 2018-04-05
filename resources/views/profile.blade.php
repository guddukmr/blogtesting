@include('header')
<html>
<body>
    <h2>Change password </h2>
    <form method="POST" action="pupdate">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="password">Old Password:</label>
            <input type="password" class="form-control" id="opassword" name="opassword" required>
        </div>
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
 
          <div class="form-group">
            <label for="cpassword">Conform Password:</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" required>
        </div>  

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>

        <!-- if there are login errors, show them here -->
     @if(!$errors->isEmpty())
       <div class="form-group">
           {{ $errors}}        
 </div>
 @endif
    </form>
</body>
</html>