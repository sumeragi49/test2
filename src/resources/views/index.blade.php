@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="index-form_content">
    <div class="index-form_header">
        <h1 class="header-title">商品一覧</h1>
        <div class="header-button">
            <a class="register-button" href="/products/register">+ 商品を追加</a>
        </div>
    </div>
    <div class="index-form_left">
        <form class="search-form" action="/products/search" method="get">
            @csrf
            <div class="search-form_item">
                <input class="search-form_item-input" type="text" name="keyword" value="{{ old('keyword') }}">
                <button class="search-form_button-submit" type="submit">検索</button>
            </div>
            <div class="search-form_title">
                <h2>価格順で表示</h2>
                <select onchange="window.location.href='?sort=' + this.value"  name="sort" id="sort">
                    <option value="">価格で並び替え</option>
                    <option name="desc" value="high_price">高い順に表示</option>
                    <option name="asc" value="low_price">低い順に表示</option>
                </select>
            </div>
        </form>
    </div>
    <div class="index-form_detail">
        <div class="detail-item">
            @foreach($products as $product)
            <a href="/products/detail/{{ $product['id'] }}">{{ $product['name'] }}</a>
            <div class="detail-item_image">
                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}">
            </div>
            <div class="detail-item_label">
                <input type="text" name="name" value="{{ $product['name'] }}" readonly />
                <input type="number" name="price" value="{{ $product['price'] }}" readonly />
            </div>
            @endforeach
        </div>
    </div>
    {{ $products->links() }}
</div>
@endsection