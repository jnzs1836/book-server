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

    public function index(){
        $books = Book::orderby('name','decs')->get();
        return json_encode($books);
    }

    public function availableBooks(Request $request){
//        $request->input('')
        $books = Book::orderby('name','decs')->get()->filter(function ($item) {
            return $item->quantity > 0;
        });;
        $json = ['message'=>'所有书籍','data'=>$books];
        response()->json($json,200);
    }


    public function post(Request $request){
        $rules = ['quantity' => 'required', 'name' => 'required','author'=>'required'];
//        $validator = Validator::make($request->all(),$rules);
//        return $request;
        $this->validate($request,$rules);
        if(1){
            $book = new Book;
            $book->quantity = $request->get('quantity');
            $book->name = $request->get('name');
            $book->stock = $request->get('quantity');
            $book->author = $request->get('author');
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

    public function patch(Request $request){

    }
//    public function post(){
//        $book = new Book();
//        $book->name = "demo";
//        $book->author = "Xinghong Zhang";
//        $book->author = "Zhejiang University Press";
//
//        $record = new Record();
//        $record->returned = TRUE;
//        // $book->title = "demo";
//        $record->save();
//        $book->records()->save($record);
//
//        $book->save();
//        return "Hello Book";
//    }

}
