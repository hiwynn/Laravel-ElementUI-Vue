<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhoneList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PhoneListController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        if (!$user) {
            return view('auth.login');
        }

        if (Gate::denies('show-phone')) {
            return view('role.inactive');
        }

        if (Gate::allows('show-phone')) {
            $phone = PhoneList::get();

            return view('list.index', compact('phone', 'phone'));
        }
    }

    public function search()
    {
        $title = request('title');
        $number = request('number');

        return PhoneList::where('title', 'like', '%' . $title . '%')->where(
            'phone_number',
            'like',
            "%{$number}%"
        )->get();
    }

    public function add()
    {
        $title = request('title');
        $number = request('number');

        return PhoneList::create(
            [
                'title' => $title,
                'phone_number' => $number,
                'find_counts' => 0,
                'added_by' => 0,
                'updated_by' => 0
            ]
        );
    }

    public function deletePhone($id)
    {
        return PhoneList::where('id', '=', $id)->delete();
    }

    public function updatePhone($id)
    {
        $title = request('title');
        $number = request('number');
        PhoneList::where('id', '=', $id)->update(
            [
                'title' => $title,
                'phone_number' => $number,
            ]
        );

        return PhoneList::where('id', '=', $id)->first();
    }
}
