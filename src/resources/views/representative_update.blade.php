<x-app-layout>
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/representative.css') }}">
    @endsection
    <div class="shop-register h-max flex justify-center md:mt-4">
        <div class="shop-register--color w-max bg-blue-600 text-white flex flex-col justify-center items-center md:rounded-lg">
            <h1 class="shop-register__title text-lg font-bold">店舗情報更新フォーム</h1>
            <form action="/shop/update/{{$shop_id}}" method='post' enctype="multipart/form-data" class="shop-register__form flex flex-col justify-center items-center">
                @csrf
                <table class="shop-register__content text-base font-bold">
                    <tr class="shop-register__content__shop-name">
                        <td>
                            <label for="" class="shop-register__content__shop-name__label">店舗名</label>
                        </td>
                        <td>
                            <input class="shop-register__content--text-input" type="text" name="shop_name" id="shop_name" value="{{$shop->shop_name}}">
                        </td>
                    </tr>
                    <tr class="shop-register__content__area">
                        <td>
                            <label for="" class="shop-register__content__area__label">エリア</label>
                        </td>
                        <td class="shop-register__content--text-input" >
                            <select name="area" id="area" type="text">
                                <option value="{{ $shop->area }}" selected>{{ $shop->area }}</option>
                                @foreach(config('pref') as $key => $score)
                                    <option value="{{ $score }}">{{ $score }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="shop-register__content__genre">
                        <td>
                            <label for="" class="shop-register__content__genre__label">ジャンル</label>
                        </td>
                        <td class="shop-register__content--text-input" >
                            <select name="genre" id="genre" type="text">
                                <option value="{{ $shop->genre }}">{{ $shop->genre }}</option>
                                @foreach(config('genre') as $key => $genre)
                                    <option value="{{ $genre }}">{{ $genre }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="shop-register__content__shop-desc">
                        <td>
                            <label for="" class="shop-register__content__genre__label">店舗説明</label>
                        </td>
                        <td class="shop-register__content--text-input" >
                            <textarea name="shop_desc" id="shop_desc" cols="30" rows="10">{{ $shop->shop_desc }}</textarea>
                        </td>
                    </tr>
                </table>
                <input class="shop-register__content__image" type="file" name="image" id="image">
                <input class="shop-register__content__button w-full bg-blue-700 mb-0 p-4 md:rounded-lg" type="submit" value="店舗情報登録">
            </form>
        </div>
    </div>
</x-app-layout>