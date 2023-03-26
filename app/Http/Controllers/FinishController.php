<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Finish;

class FinishController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 売却商品一覧
     */
    public function Sold()
    {
        // 商品一覧取得
        $items=Item::where('items.status', 'passive')
            ->select()
            ->get();

        return view('item.solds', compact('items'));
    }

/**
    * 検索機能 
    */ 
    public function search(Request $request)
    {
        //検索boxに入力された値を受け取り、$keywordに格納
        $keyword = $request->input('keyword');
        $query = Item::query();
        //$keywordで何かしらの値を受け取った場合、if文の中で取得するデータを絞りこむ
        if(!empty($keyword)) {
        $query->where('name', 'LIKE', "%{$keyword}%");
        }
        $items = $query->get();
        //items(一覧表示するデータ)とkeyword(検索ボックスのvalue値)をindex.blabe.php受け渡す。
        return view('item.index', compact('items', 'keyword'));
    }

    /**
     * 商品削除
     */
    public function destroy(Request $request)
    {
        //（今作のpoint）変数を理解する//

        $deleteId = $request->deleteId;
        //Itemsテーブルから特定のIDレコードを一件取得する
        $item = Item::find($deleteId);
        //レコードを削除
        $item->delete();
        //削除後、一覧画面にリダイレクトする
        return redirect('/items');
    }

    /**
     * 取り消し操作
     */
        /**
     * データ送信ボタン(/items->/finishへ{id}に入っている情報を渡す)
     */
    public function CancelId(Request $request)
    {
       // 商品一覧取得
        $items = Item::where('items.status',"=",'passive')
        ->select()
        ->save();
        return redirect('/items/sold');
    }

    public function Updateing(Request $request)
    {
        
        $FinishId = $request->CancelId; 
        $item =Item::find($FinishId);
        $item->status ='active';
        $item->save();
        return redirect('/items/sold');
    }
    };