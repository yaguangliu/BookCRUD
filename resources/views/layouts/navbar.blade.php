<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Favorite Books</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-3 ms-5">
            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item me-5">
            <a class="nav-link" href="{{ route('create') }}">Add Books</a>
            </li>
        </ul>
        <form class="d-flex" action="{{ route('search') }}" method="GET" role="search">
            <select name="searchField" id="searchField" class="me-1 border border-1 rounded" style="border-color:#eee;">
                <option value="title">Title</option>
                <option value="author">Author</option>
                <option value="publisher">Publisher</option>
                <option value="category">Category</option>
            </select>
            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="value">
            <button class="btn btn-outline-success me-1" type="submit">Search</button>   
                    
        </form>       
        
        </div>
    </div>
</nav>