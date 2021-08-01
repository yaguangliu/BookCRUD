@extends('layouts.main')
@section('content')


<div class="container mt-5 mb-5">
    
    <!--add owner-->
    <div class="card col-md-8 offset-md-2">
        <div class="card-header">
            Update Book
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('update', $book->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Book Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $book->title}}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" value="{{ $book->author}}">
                    @error('author')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="mb-3">
                    <label for="publisher" class="form-label" >Publisher</label>
                    <input type="text" class="form-control" name="publisher" value="{{ $book->publisher}}">
                    @error('publisher')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" value="{{ $book->category}}">
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="des" class="form-label">Description</label><br>
                    <textarea name="desc" id="" cols="110" rows="5">{{ $book->desc}}</textarea>
                    @error('desc')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bookImg" class="form-label" >Book Image:</label><br>
                    <input type="file" name="bookImg" onchange="previewFile(this)"/>
                    @error('bookImg')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="d-inline-block">
                       {{--<img src="{{ asset('/storage/app/'.$book->image)}}" alt="" style="height:120px;">--}} 
                        <img src="{{ asset('/storage/app/'.$book->image)}}" alt="image" style="max-width:120px;" id="previewImg"/>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>

    @if(session('successMsg'))
        <div class="alert alert-success container" role="alert">            
            {{session('successMsg')}}                        
        </div>
        
    @endif
    <script>
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $('#previewImg').attr("src",reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    
    </script>
    
    

</div>
@endsection