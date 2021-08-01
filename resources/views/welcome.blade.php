@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 mt-3 bg-light py-3">
    <form class="d-flex" action="{{ route('sort') }}" method="GET" role="sort" style="height:36px; margin-left:10px;">
        @csrf
        <select name="sort" id="sortField" class="me-1 border border-1 rounded" style="border-color:#eee;" 
        onchange="this.form.submit()">  
            <option value="">Sort by: Featured</option>          
            <option value="sortIdDesc">Id: Big to Small</option>  
            <option value="categoryAZ">Category: A-Z</option>
            <option value="categoryZA">Category: Z-A</option>                     
        </select>         
    </form>      
</div>

<div class="col-md-10 offset-md-1 mb-3" style="bottom:30px;"> 
   {{-- @if(is_countable($books) && count($books) > 0)--}}
   @if(isset($books))
    <table class= "table table-striped border border-1 shadow-sm" style="border-color:#eee;">
        <thead style="background-color:#d9eded;">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Author</th>
            <th scope="col">Publisher</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <th>{{ $book->id }}</th>
                <td>
                    <img src="{{ asset('/storage/app/'.$book->image)}}" alt="" style="height:75px;">
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->desc }}</td>
                <td>
                    <a href="{{ route('edit', $book->id) }}" class="btn-raised btn btn-info btn-sm text-light shadow ">
                        <i class="fas fa-user-edit" ></i>
                    </a>
                    <form action="{{ route('delete', $book->id)}}" method="POST" enctype="multipart/form-data" 
                    style="display:none;" id="delete-form-{{ $book->id }}"> 
                        {{ csrf_field() }}
                        {{ method_field('delete')}}            
                    </form>   
                    <button onclick="if(confirm('Are you sure to delete this data?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{ $book->id}}').submit();
                        }else{
                            event.preventDefault();
                        }"
                        class="btn-raised btn btn-danger btn-sm text-light shadow" href="" type="submit">
                        <i class="fas fa-user-times" aria-hidden="true"></i>
                    </button>             
                    
                </td>
            </tr>
            @endforeach
        </tbody>        
    </table>
    <div class="d-flex justify-content-center">
        
        {!! $books->render()!!}
    </div>
     @else
        No book available.
    @endif 
   
    
    @if(session('successMsg'))
        <div class="alert alert-success container" role="alert">            
            {{session('successMsg')}}                        
        </div>
        
    @endif 
</div>
@endsection