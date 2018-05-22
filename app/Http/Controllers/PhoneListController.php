<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhoneList;

class PhoneListController extends Controller
{
    public function index()
    {
        $phone = PhoneList::get();
        return view('list.index', compact('phone', 'phone'));
    }

    public function search()
    {
        $title = request('title');
        $number = request('number');
        return PhoneList::where('title', 'like', '%' . $title . '%')->where('phone_number', 'like', "%{$number}%")->get();
    }
}
