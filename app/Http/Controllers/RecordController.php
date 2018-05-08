<?php
/**
 * Created by PhpStorm.
 * User: ktwzj
 * Date: 2018/5/4
 * Time: 17:10
 */

namespace App\Http\Controllers;


use App\Admin;
use App\Application;
use App\Card;
use App\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(){
        $records = Record::all();
        return $this->sendData("已返回所有借书记录",$records);
    }

    public function available(){
        $records = Record::all()->filter(function ($item){
            return $item->returned == False;
        });
        return $this->sendData('已返回所有待归还记录',$records);
    }

    public function returnBook(Request $request){
        $id = $request->input('id');
        $record = Record::find($id);
//        $record = new Record();
        if($record->returned == True){
            return $this->fail('该书已经归还');
        }else{
            $record->returned = True;
//            $record->book()->get()->stock++;
//            $record->book()->stock++;
            $record->save();
            return $this->sendData('还书成功',[]);
        }
    }


    public function dealApplication(Request $request){
        $id = $request->input('id');
        $admin = Admin::find(1);
        $operation = $request->input('operation');
        $application = Application::find($id);
        if($application->status!='pending'){
            return $this->fail('申请已失效');
        }
        if($operation == 'consent'){
            $record = new Record();
            $record->fromApplication($application,$admin);
            $application->status = 'consented';
            $record->save();
            return response()->json([
                'message' => '成功借书'
            ],200);
        }else if($operation == 'reject'){
            $application->status = 'rejected';
            $application->save();
            return response()->json([
                'message' => '拒绝借书'
            ],200);
        }else{
            return $this->fail('操作不合法');
        }
    }
}