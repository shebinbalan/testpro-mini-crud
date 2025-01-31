<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Crud-App </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('product_view')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('categories')}}">Category List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('products')}}">Product List</a>
        </li>
       
       
      </ul>
      @if(Auth::check())  <!-- Check if the user is authenticated -->
      <a href="{{ route('logout') }}" class="btn btn-danger"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
  @endif
    </div>
  </div>
</nav>