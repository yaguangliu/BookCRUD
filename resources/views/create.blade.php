@extends('layouts.main')
@section('content')


<div class="container mt-5 mb-5">
    
    <!--add your favorite books -->
    <div class="card col-md-8 offset-md-2">
        <div class="card-header">
            Add Book
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('save') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Book Title</label>
                    <input type="text" value="{{old('title')}}" class="form-control" name="title" placeholder="Book Title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" value="{{old('author')}}" class="form-control" name="author" placeholder="Author">
                    @error('author')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="mb-3">
                    <label for="publisher" class="form-label" >Publisher</label>
                    <input type="text" value="{{old('publisher')}}" class="form-control" name="publisher" placeholder="Publisher">
                    @error('publisher')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" value="{{old('category')}}" class="form-control" name="category" placeholder="Category">
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="des" class="form-label">Description</label><br>
                    <textarea name="desc" value="{{old('desc')}}" id="" cols="110" rows="5" placeholder="Your description"></textarea>
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
                        <img alt="Book Image" style="max-width:120px;" id="previewImg"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
                
            </form>
        </div>
    </div>  
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