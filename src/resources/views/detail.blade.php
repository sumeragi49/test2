@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<form class="form" action="/products/{{ $products['id'] }}/update" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div class="detail_content">
        <div class="detail_content-image">
            <img src="{{ asset('images/' . $products['image']) }}" alt="{{ $products['name'] }}">
            <input type="file" name="image">
            <input type="hidden" name="id" value="{{ $products['id'] }}">
        </div>
        <div class="form_error">
            @error('image')
            {{ $message }}
            @enderror
        </div>
        <div class="detail_content-right">
            <div class="form_group-title">
                <span class="form_label-item">商品名</span>
            </div>
            <div class="form_group-content">
                <input type="text" name="name" value="{{ $products['name'] }}" />
                <input type="hidden" name="id" value="{{ $products['id'] }}">
            </div>
            <div class="form_error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="form_group-title">
                <span class="form_label-item">値段</span>
            </div>
            <div class="form_group-content">
                <input type="number" name="price" value="{{ $products['price'] }}" />
                <input type="hidden" name="id" value="{{ $products['id'] }}">
            </div>
            <div class="form_error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
            <div class="form_group-content">
                <input type="radio" name="season_id" value="{{ $products['season_id'] }}">春
                <input type="hidden" name="id" value="{{ $products['id'] }}">
                <input type="radio" name="season_id" value="{{ $products['season_id'] }}">夏
                <input type="hidden" name="id" value="{{ $products['id'] }}">
                <input type="radio" name="season_id" value="{{ $products['season_id'] }}">秋
                <input type="hidden" name="id" value="{{ $products['id'] }}">
                <input type="radio" name="season_id" value="{{ $products['season_id'] }}">冬
                <input type="hidden" name="id" value="{{ $products['id'] }}">
            </div>
            <div class="form_error">
                @error('season_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="detail_content-under">
            <div class="form_group-title">
                <span class="form_label-item">商品説明</span>
            </div>
            <div class="form_group-content">
                <textarea name="description" value="{{ $products['description'] }}">{{ $products['description'] }}</textarea>
                <input type="hidden" name="id" value="{{ $products['id'] }}">
            </div>
            <div class="form_error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form_button-return" type="button" onClick="history.back()">戻る</button>
            <button class="form_button-update" type="submit">登録</button>
        </div>
    </div>
</form>
<form class="delete-form" action="/products/{{ $products['id'] }}/delete" method="post">
    @method('DELETE')
    @csrf
    <div class="delete-form_button">
        <input type="hidden" name="id" value="{{ $products['id'] }}">
        <button class="delete-form_button-submit" type="submit">削除</button>
    </div>
</form>
@endsection