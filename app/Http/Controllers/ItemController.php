<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;


class ItemController extends Controller
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
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::where('items.status', 'active')
            ->select()
            ->get();

        return view('item.index', compact('items'));
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
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
        
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
     * 売却データ送信ボタン(/items->/finishへ{id}に入っている情報を渡す)
     */
    public function  Finished(Request $request)
    {
       // 商品一覧取得
        $items = Item::where('items.status', 'passive')
        ->select()
        ->save();
        // return view('item.index', compact('items'));
        return redirect('/items/finish');
    }

    public function Update(Request $request)
    {
        // var_dump($request->update)
        $FinishId = $request->FinishId; 
        $item = Item::find($FinishId);
        
        $item->status ='passive';
        $item->save();
        return redirect('/items');
    }

    /**
     * 売却済み一覧の表示
     */

    public function soldout()
    {
        // 商品一覧取得
        $items = Item::where('items.status', 'passive')
            ->select()
            ->get();

        return view('/itemes/soldout', compact('items'));
    }    

    /**
     * 売却キャンセル
     */
    public function Cancel(Request $request)
    {
        // 商品一覧取得
        $items = Item::where('items.status', 'active')
        ->select()
        ->save();
        return redirect('/items/canceling');
    }

    public function Updateing(Request $request)
    {
        
        $FinishId = $request->FinishId; 
        $item = Item::find($FinishId);
        
        $item->status ='active';
        $item->save();
        return redirect('/items/sold');
    }
}