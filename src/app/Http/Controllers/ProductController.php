<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    //indexメソッドを使用する。
    public function index(Request $request)
    {
        //変数productsをproductモデルからseasonモデルとリレーションを組みデータを取得する。
        $products = Product::with('seasons')->get();
        //変数seasonはseasonモデルからすべてのデータを取得する。
        $seasons = Season::all();
        //変数productは1ページあたり6データごとに表示する。
        $products = Product::simplePaginate(6);
        //index.blade.phpを表示する
        return view('index', compact('products', 'seasons'));
    }
    //searchメソッドを使用する
    public function search(Request $request)
    {
        //変数productsはproductモデルからkeywordを呼び出し、searchメソッドを起動する
        $products = Product::all()->Search($request->keyword);
        //変数keywordはフォームで指定されたkeywordを呼び出したもの
        $keyword = $request->input('keyword');
        //変数sortOrderはデフォルトをdescとして指定されたsortを呼び出す
        $sortOrder = $request->input('sort', 'desc');
        //仮定 変数sortOrderが「高い順に表示」の時
        if($sortOrder == "高い順に表示")
        {
            //変数sortOrderは「high_price」とする
            $sortOrder = "high_price";
        }
        //または 変数sortOrderは「low_price」の時
        elseif ($sortOrder == "低い順に表示")
        {
            //変数sortOrderは「low_price」とする
            $sortOrder = "low_price";
        }
        //それ以外の時
        else{
            //変数sortOrderは「選択なし」とする
            $sortOrder = "";
        }
        //仮定 変数$sortOrderが「high_price」の時
        if($sortOrder == "high_price")
        {
            //変数query_productsは変数productsを「priceをsortByDescで並べたもの」とする
            $query_products = $products->sortByDesc('price');
        }
        //または 変数sortOrderは「low_price」の時
        elseif($sortOrder == "low_price")
        {
            //変数query_productsは変数productsを「priceをsortByで並べたもの」とする
            $query_products = $products->sortBy('price');
        }
        //それ以外の時は
        else
        {
            //変数sortOrderが「選択なし」の時
            $sortOrder = "";
            //変数query_productsは変数productsデフォルト(id状態で早い順)で並べる
            $query_products = $products;
        }
        //変数productsはproductモデルから1ページあたり6個のデータを表示する
        $products = Product::simplePaginate(6);
        //変数products,sortOrder,query_productsをindex.blade.phpに返す。
        return view('index', compact('products', 'sortOrder','query_products'));
    }

    //showメソッドを使用する。
    public function show($product_id)
    {
        //productモデルから指定したproduct_idのデータを変数productsとする。
        $products = Product::find($product_id);
        //変数productsをdetailに表示する。
        return view('detail', compact('products'));
    }

    //updateメソッドを使用する（productRequestのバリデーションを使用する)
    public function update(ProductRequest $request)
    {
        //変数productsは「name」「image」「price」「description」を呼び出す
        $products = $request->only(['name', 'image', 'price','season_id', 'description']);
        //「product_id」を呼び出し、変数productsを更新する
        Product::find($request->product_id)->update($products);
        //仮定「images」が呼び出された時
        if(request('images')) {
            //file(images)を呼び出し、名称を変更して変数nameとする
            $name = request()->file('images')->getClientOriginalName();
            //file(images)を呼び出し、storageのimagesに移動する
            request()->file('image')->move('storage/images',$name);

            $post->image = $name;
        }
        //index.blade.phpにリダイレクトする。
        return redirect('/products');
    }

    

    //createメソッドを使用する
    public function create(Request $request)
    {
        //変数seasonsはseasonモデルの全てに接続する
        $seasons = Season::all();
        //変数seasonsをregister.blade.phpに返す
        return view('register', compact('seasons'));
    }
    //storeメソッドを使用する（productRequestのバリデーションを使用する）
    public function store(ProductRequest $request)
    {
        //変数productsは「name」「price」「image」「season_id」「description」を呼び出す
        $products = $request->only(['name', 'price', 'image','season_id', 'description']);
        //productモデルから変数$productsを作成する
        Product::create($products);
        //仮定 「images」を呼び出した時、
        if(request('images')) {
            //file「images」を呼び出し、DBに保存するとき、名称を変更して変数nameとする
            $name = request()->file('images')->getClientOriginalName();
            //file「images」を呼び出し、$nameをstorageのimagesに移動させる。
            request()->file('images')->move('storage/images', $name);
            //
            $post->image = $name;
        }
        //register.blade.phpに返す
        return view('register');
    }

}
