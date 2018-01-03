<!DOCTYPE html>
<html lang="en">
@include('layout.layout')
  @yield('head')
  <body class="signup">
  <div class="container">
    <div class="col-sm-6 mx-auto">
      <div class="card mt-5">
        <div class="card-body">
          <h1 class="text-center">
            <span class="fa fa-user"></span> Signup
          </h1>
          <!-- form -->
          <form id="frm_signup">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <input type="submit" class="btn btn-outline-secondary btn-lg" value="Create">
          </form>

          <hr>
          <div class="text-center">
            <p>Already have an account? <a href="/">Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
@yield('footer')
@yield('signup')
</html>
