<x-app-layout>
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/representative.css') }}">
    @endsection
    <div class="shop-content flex">
        <div class="shop-register w-1/2 h-max flex justify-center md:mt-4">
            <div class="shop-register--color w-max bg-blue-600 text-white flex flex-col justify-center items-center md:rounded-lg">
                <h1 class="shop-register__title text-lg font-bold">店舗情報登録フォーム</h1>
                <form action="/shop/register" method='post' enctype="multipart/form-data" class="shop-register__form flex flex-col justify-center items-center">
                    @csrf
                    <table class="shop-register__content text-base font-bold">
                        <tr class="shop-register__content__shop-name">
                            <td>
                                <label for="" class="shop-register__content__shop-name__label">店舗名</label>
                            </td>
                            <td>
                                <input class="shop-register__content--text-input" type="text" name="shop_name" id="shop_name">
                            </td>
                        </tr>
                        <tr class="shop-register__content__area">
                            <td>
                                <label for="" class="shop-register__content__area__label">エリア</label>
                            </td>
                            <td class="shop-register__content--text-input" >
                                <select name="area" id="area" type="text">
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
                                <textarea name="shop_desc" id="shop_desc" cols="30" rows="10"></textarea>
                            </td>
                        </tr>
                    </table>
                    <input class="shop-register__content__image" type="file" name="image" id="image">
                    <input class="shop-register__content__button w-full bg-blue-700 mb-0 p-4 md:rounded-lg" type="submit" value="店舗情報登録">
                </form>
            </div>
        </div>
        <div class="registered-shops w-1/2 md:mt-4">
            <div class="content__item__favorite md:ml-8 md:mr-8  max-md:flex justify-center items-center flex-col max-md:mt-8">
                <p class="title">登録済店舗</p>
                <div class="content__item__favorite__card">
                    <div class="shop grid auto-rows-full sm:grid-cols-2 gap-x-2 gap-y-8 mt-4">
                        @foreach($RegisteredShops as $RegisteredShop)
                        <form action="/shop/update/{{ $RegisteredShop->id }}" method="get">
                        @csrf
                            <div class="shop_card h-max flex flex-col  sm:rounded-lg shadow-lg">
                                <img src="{{ $RegisteredShop->pic_url }}" alt="写真" class="shop_eye-catch h-3/5 sm:rounded-t-lg">
                                <p class="shop_desc_shop-name font-extrabold pl-2 py-2">{{ $RegisteredShop->shop_name }}</p>
                                <div class="shop_card_item_hash flex pl-2">
                                    <p class="shop_desc_area">#{{ $RegisteredShop->area }}</p>
                                    <p class="shop_desc_genre">#{{ $RegisteredShop->genre }}</p>
                                </div>
                                <div class="shop_card_item_desc my-4">
                                    <h2 class="font-bold">説明文</h2>
                                    <p class="tracking-wide">{{ $RegisteredShop->shop_desc }}</p>
                                </div>
                                <button class="text-white py-1 bg-blue-600 sm:rounded-b-lg" type="submit">
                                    情報更新
                                </button>
                            </div>
                        </form>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>