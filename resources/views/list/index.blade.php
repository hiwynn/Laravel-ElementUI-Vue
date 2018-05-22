@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="title">
                        <h2 style="text-align: center; margin-top: 40px;">电话查询系统</h2>
                    </div>
                    <div style="padding: 30px">
                        <search-area phone="{{ $phone }}"></search-area>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
