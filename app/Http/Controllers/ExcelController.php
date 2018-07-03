<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\PhoneList;
use Illuminate\Support\Facades\Schema;
use Redirect;

class ExcelController extends Controller
{
    public function export()
    {
        $cellData = [
            ['学号', '姓名', '成绩'],
            ['10001', 'AAAAA', '99'],
            ['10002', 'BBBBB', '92'],
            ['10003', 'CCCCC', '95'],
            ['10004', 'DDDDD', '89'],
            ['10005', 'EEEEE', '96'],
        ];
        Excel::create('学生成绩', function ($excel) use ($cellData) {
            $excel->sheet('score', function ($sheet) use ($cellData) {
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

    public function exportPhone()
    {
        $columnNames = Schema::getColumnListing('phone_lists');
        $data = [];
        array_push($data, $columnNames);
        $phoneList = PhoneList::all();
        foreach ($phoneList as $value) {
            $phone = [];
            foreach (json_decode($value) as $valueKey => $valueVal) {
                array_push($phone, $valueVal);
            }
            array_push($data, $phone);
        }

        Excel::create('电话簿', function ($excel) use ($data) {
            $excel->sheet('phone', function ($sheet) use ($data) {
                $sheet->rows($data);
            });
        })->export('xls');
    }

    public function importPhone(Request $request)
    {
        if (!$request->hasFile('file')) {
            exit('上传文件为空！');
        }
        $file = $_FILES;
        $excel_file_path = $file['file']['tmp_name'];
        $res = [];
        Excel::load($excel_file_path, function ($reader) use (&$res) {
            $reader = $reader->getSheet(0);
            $res = $reader->toArray();
        });
        for ($i = 1; $i < count($res); $i++) {
            if (count(PhoneList::where('title', $res[$i][0])->get())
                || count(PhoneList::where('phone_number', $res[$i][2])->get())
            ) {
                continue;
            }
            $list = new PhoneList;
            $list->title = $res[$i][0];
            $list->phone_number = $res[$i][2];
            $list->find_counts = 0;
            $list->save();
        }
        return Redirect::to('/')->withSuccess("导入成功");
    }
}
