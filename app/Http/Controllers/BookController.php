<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator;


use App\Book;
use App\Record;

class BookController extends Controller{
    public function hello(){
        return "Hello Wolrd";
    }

    // public function index(){
    //     $books = Book::orderby('name','decs')->get();
    //     return json_encode($books);
    // }

    public function get($id){
        $book = Book::where('id',$id)->first();
        return json_encode($book);
    }

    public function availableBooks(Request $request){
//        $request->input('')
        $books = Book::orderby('name','decs')->get()->filter(function ($item) {
            return true;
        })
        ;
        $json = ['message'=>'所有书籍','data'=>$books];
        response()->json($json,200);
    }


    public function index(Request $request){
        $searchParam = $request->input('search_param');
        $searchParam =  "%". $searchParam. "%";
        $books = Book::where('name', 'like', $searchParam)->orWhere('author', 'like', $searchParam)->orderby('name','decs')->get()->filter(function ($item) {
            return true;
        });
        $json = ['message'=>'所有书籍','data'=>$books];
        return response()->json($json,200);
    }

    public function post(Request $request){
        $rules = ['name' => 'required','author'=>'required', 'sell_price' => 'required', 'origin_price' => 'required'];
//        $validator = Validator::make($request->all(),$rules);
//        return $request;
        $this->validate($request,$rules);
        if(1){
            $book = new Book;
            $book->name = $request->get('name');
            $book->author = $request->get('author');
            $book->sell_price = $request->get('sell_price');
            $book->origin_price = $request->get('sell_price');
            if($request->has('category')){
                $book->press = $request->input('category');
            }
            if($request->has('isbn')){
                $book->press = $request->input('isbn');
            }
            if($request->has('press')){
                $book->press = $request->input('press');
            }
            if($book->save()){
                $json = [
                    'message' => '创建成功'
                ];
                $status = 200;
            }else{
                $json = [
                    'message' => '创建失败'
                ];
                $status = 500;
            }

        }else{
            $json = [
                'message' => '书籍信息不符合要求'
            ];
            $status = 422;
        }

        return response()->json( $json, $status);

    }

    public function update(Request $request){
        $book = Book::where('id', '=', $request->input("book_id"))->first();
        
        $res = [];
        $status = 404;
        // $owner = $book->owner;
        // $id = $owner->id;
        if($book->owner->id != $request->user()->id){
            $res = [
                'message'=> 'book not belongs to you!',
                'updated' => false,
            ];
            $status = 403;
        }else {
            $input = $request->all();
            foreach($input as $key => $value){
                if($key != "book_id" && $key != "api_token"){
                    $book[$key] = $value;
                }
                
            }

            if($book->save()){
                $res = [
                    'message'=> 'success',
                    'updated' => true,
                ];
                $status = 200;
            }else{
                $res = [
                    'message'=> 'fail',
                    'updated' => fail,
                ];
                $status = 500;
            }
            
        }
        return response()->json($res,$status);

    }

    public function uploadPhoto(Request $request){
        $image = $request->file('image');
        $image->storeAs('public', "sas.jpg"); // => storage/app/public/file.img

    }

    public function bookList(Request $request){
        $books = Book::all();
        return response()->json(['data'=>$books], 200);
    }

//    
}
