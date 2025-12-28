@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="register-form_content">
    <div class="register-form_heading">
        <h1>商品登録</h1>
    </div>
    <form class="form" action="/products" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label--item">商品名</span>
                <span class="form_label--required">必須</span>
            </div>
            <div class="form_group-content">
                <div class="form_input--text">
                    <input type="text" name="name" placeholder="商品名を入力">
                </div>
                <div class="form_error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label--item">値段</span>
                <span class="form_label--required">必須</span>
            </div>
            <div class="form_group-content">
                <div class="form_input--text">
                    <input type="number" name="price" placeholder="値段を入力">
                </div>
                <div class="form_error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label--item">商品画像</span>
                <span class="form_label--required">必須</span>
            </div>
            <div class="form_group-content">
                <div class="form_input--image">
                    <input type="file" name="image">
                </div>
                <div class="form_error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label--item">季節</span>
                <span class="form_label--required">必須</span>
            </div>
            <div class="form_group-content">
                <div class="form_input--radio">
                    <input type="radio" name="season_id" value="1">春
                    <input type="radio" name="season_id" value="2">夏
                    <input type="radio" name="season_id" value="3">秋
                    <input type="radio" name="season_id" value="4">冬
                </div>
                <div class="form_error">
                    @error('season_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label--item">商品説明</span>
                <span class="form_label--required">必須</span>
            </div>
            <div class="form_group-content">
                <div class="form_input--textarea">
                    <textarea name="description" placeholder="商品の説明を入力"></textarea>
                </div>
                <div class="form_error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form_button-return" type="button" onClick="history.back()">戻る</button>
            <button class="form_button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection