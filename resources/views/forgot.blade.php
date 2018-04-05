@include('header1')
<html>
<body>
    <h2>Login </h2>
    <form method="POST" action="passwordsend">
        {{ csrf_field() }}

       

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>


        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Next</button>
        </div>
       
    </form>

</body>
</html>