<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Input;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = books::paginate(6);
        
        return view('welcome', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'author'=>'required',
            'publisher'=>'required',
            'category'=>'required',
            'desc'=>'required|max:100',
            'bookImg'=>'required',
        ]);

        $path = $request->file('bookImg')->store('public/images');

        $book = new books;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->category = $request->category;
        $book->desc = $request->desc;
        $book->image = $path;
      

        $book->save();
        return redirect(route('home'))->with('successMsg','Book has been successfully added.');  
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = books::find($id);
        return view('edit',compact('book'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'author'=>'required',
            'publisher'=>'required',
            'category'=>'required',
            'desc'=>'required',
        ]);
        $book = books::find($id);
        if($request->hasFile('bookImg')){
            $request->validate([
                'bookImg'=>'required',
            ]);
            $path = $request->file('bookImg')->store('public/images');
            $book->image = $path;
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->category = $request->category;
        $book->desc = $request->desc;
        $book->save();
        return redirect(route('home'))->with('successMsg','Book has been successfully updated.');

    }

    public function search(Request $request)
    {
       $key = $request->get('searchField');
        $value = $request->get('value');

        if($value != ''){
            switch($key){
                case 'title':
                    $books = books::where('title','LIKE','%'.$value.'%')
                        ->paginate(2)
                        ->setpath('search?searchField='.$key);
                    $books->appends(array(
                        'value'=>$request->get('value'),
                    ));
                    break;
                case 'author':
                    $books = books::where('author','LIKE','%'.$value.'%')
                        ->paginate(2)
                        ->setpath('search?searchField='.$key);
                    $books->appends(array(
                        'value'=>$request->get('value'),
                    ));
                    break;
                 case 'publisher':
                    $books = books::where('publisher','LIKE','%'.$value.'%')
                        ->paginate(2)
                        ->setpath('search?searchField='.$key);
                    $books->appends(array(
                        'value'=>$request->get('value'),
                    ));
                    break;
                    case 'category':
                        $books = books::where('category','LIKE','%'.$value.'%')
                        ->paginate(2)
                        ->setpath('search?searchField='.$key);
                        $books->appends(array(
                        'value'=>$request->get('value'),
                    ));   
                    break;                
                    
            }

            if(count($books)>0){
                return view('welcome',compact('books'));
            }
            return view('welcome')->withMessage('no file found');
        }
       
    }

    public function sort(Request $request)
    {
        // $books = books::all();
        // $books = $books->sortBy('id');
        // $books->values()->all();
        $key = $request->get('sort');
        //echo $key;
        $books;
        switch($key)
        {          
            case 'sortIdDesc':
                $books=DB::table('books')->orderBy('id','desc')->paginate(6);
                break;
            case 'categoryAZ':
                $books=DB::table('books')->orderBy('category','asc')->paginate(6);
                break;
            case 'categoryZA':
                $books=DB::table('books')->orderBy('category','desc')->paginate(6);
                break;

        }
        // $books = books::orderBy('id','desc')->paginate(6);
        // return view('welcome',compact('books'));
        return view('welcome',compact('books'));
        
    
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $book = books::find($id);
        //unlink(public_path('public/images').'/'.$book->image);
        $book->delete();
        return redirect(route('home'))->with('successMsg','Book has been deleted successfully.');
    }
}
