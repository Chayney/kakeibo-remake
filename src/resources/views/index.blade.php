<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>家計簿</title>
</head>
<body>
    <header>
        <div class="header_logo">
            <h1>家計簿アプリ</h1>
            <form action="/logout" method="post">
                @csrf
                <button>ログアウト</button>
            </form>
        </div>
    </header>

    <main>
        <div class="parent-container">
            <div class="child-container">
                <h2>今月の収支</h2>
                @if (session('flash_message'))
                    <div class="flash_message">
                        {{ session('flash_message') }}
                    </div>
                @endif
                @if (session('flash_error_message'))
                    <div class="flash_error_message">
                        {{ session('flash_error_message_') }}
                    </div>
                @endif
                <table>
                    <thead>
                        <tr>
                            <td>日付</td>
                            <td>カテゴリ</td>
                            <td>金額</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kakeibos as $kakeibo)
                        <tr>
                            <td>{{ $kakeibo['date'] }}</td>
                            <td>{{ $kakeibo['category']['name'] }}</td>
                            <td>{{ $kakeibo['price'] }}</td>
                            <td>
                                <form action="/edit/{{ $kakeibo['id'] }}" method="">
                                    <button type="submit">更新</button>
                                </form>
                            </td>
                            <td>
                                <form action="/delete/{{ $kakeibo['id'] }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $kakeibos->links() }}
                </div>
            </div>
            <div class="child-container">
                <h2>支出の追加</h2>
                <form action="/kakeibo" method="post">
                    @csrf
                    <p>日付</p>
                    <input type="date" name="date" value="">
                    @if ($errors->has('date')) <span>{{ $errors->first('date') }}</span> @endif
                    <p>カテゴリ</p>
                    <select name="category_id">
                        <option disabled selected>選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id')) <span>{{ $errors->first('category_id') }}</span> @endif
                    <p>金額</p>
                    <input type="text" name="price" value="">
                    @if ($errors->has('price')) <span>{{ $errors->first('price') }}</span> @endif
                    <button type="submit">追加</button>
            </div>
        </div>
</body>
</html>