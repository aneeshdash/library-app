@extends('admin.master')
@section('head')
    @endsection
@section('content')
        {{ Hash::make('fe43wg') }}
        {{ App::environment() }}
{{--    {{ Auth::admin()->get()->username }} <br>--}}
{{--    {{ $book->title }}--}}
    {{--{{ API::get('/login') }}--}}
    {{ DB::table('publications')->where('name','Pearson')->pluck('id') }}
    @endsection
@section('script')

    @endsection