<!DOCTYPE html>
<html lang="en">
@include('layout.layout')
  @yield('head')
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
  <a class="navbar-brand" href="/home"><span class="badge badge-outline-secondary">Welcome {{ Session::get('user') }}</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;
      <li class="nav-item active">
        <button class="btn btn-outline-secondary" id="new_product">New Product<span class="sr-only">(current)</span></button>
      </li>&nbsp;&nbsp;&nbsp;&nbsp;
      <li class="nav-item">
      <a class="btn btn-outline-danger" href="products/logout" >Sign off<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    
  </div>
</nav>
<br><br>

<div class="container">
<div class="row" id="list_products">

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="frm_insert_update">
      {{ csrf_field() }}
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title"  placeholder="Enter title">
            <small class="form-text text-muted">We'll never share your title with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
@yield('footer')
@yield('home')
</html>
