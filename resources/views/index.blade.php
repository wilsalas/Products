<!DOCTYPE html>
<html lang="en">
@include('layout.layout')
  @yield('head')
<body class="login">
<div class="container">
      <div class="col-md-6  mx-auto">
        <div class="card mt-5">
          <div class="card-body">
            <!-- messages -->
            <h1 class="text-center">
              <span class="fa fa-sign-in"></span> Login
            </h1>
            <!-- form -->
            <form id="frm_login" >
            {{ csrf_field() }}
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
              </div>
              <input type="submit" class="btn btn-outline-primary btn-lg" value="Send">
            </form>

            <hr>
            <div class="text-center">
              <p>Need an account? <a href="/signup">Signup</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
@yield('footer')
@yield('index')
</html>
