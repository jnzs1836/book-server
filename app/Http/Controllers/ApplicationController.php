<?php
/**
 * Created by PhpStorm.
 * User: ktwzj
 * Date: 2018/5/4
 * Time: 16:54
 */

namespace App\Http\Controllers;
use App\Application;
use App\Book;
use App\Card;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ApplicationController extends Controller
{
    public function index(){
        $applications = Application::all();
        return $this->sendData('已返回所有申请记录',$applications);
    }

    public function available(){
        $applications = Application::all()->filter(function ($item){
            return $item->status == 'pending';
        });
//        return 'Hello';
        return $this->sendData('已返回所有待批准申请记录',$applications);
    }

    public function post(Request $request){
        $card = Card::find($request->input('card_id'));
        $book = Book::find($request->input('book_id'));
        $application = new Application();
        $application->status = 'pending';
        $application->card()->associate($card);
        $application->book()->associate($book);
        $card->applications()->save($application);
        $book->applications()->save($application);
        if($card->save() && $book->save() && $application->save()){
            return $this->sendData('创建申请',[]);
        }else{
            return response()->json([
                'message' => '创建失败'
            ], 500);
        }
    }
}