<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kakeibo;
use App\Models\Category;
use App\Http\Requests\KakeiboRequest;

class KakeiboController extends Controller
{
    public function index()
    {
        // 保存されているデータをウェブ上に表示
        $kakeibos = Kakeibo::with('category')->orderBy('date', 'desc')->paginate(5); 
        $categories = Category::all();
        return view('index', compact('kakeibos', 'categories'));
    }

    public function store(KakeiboRequest $request)
    {
        $kakeibo = $request->only(['date', 'category_id', 'price']);
        Kakeibo::create($kakeibo);

        if (!empty($kakeibo)) {
            session()->flash('flash_message', '支出を登録しました');
        } else {
            session()->flash('flash_error_message', '支出を登録できませんでした');
        }

        return redirect('/');
    }

    public function edit(KakeiboRequest $request)
    {
        $kakeibo = Kakeibo::find($request->id);
        return view('edit', compact('kakeibo'));
    }

    public function update(KakeiboRequest $request)
    {
        $kakeibo = $request->only(['date', 'category_id', 'price']);
        Kakeibo::find($request->id)->update($kakeibo);

        if (!empty($kakeibo)) {
            session()->flash('flash_message', '支出を登録しました');
        } else {
            session()->flash('flash_error_message', '支出を登録できませんでした');
        }

        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Kakeibo::find($request->id)->delete();
        session()->flash('flash_message', '支出を削除しました');
        return redirect('/');
    }

}
