<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endsection
    <div class="content flex flex-col items-center">
        <form action="/search" method="post">
        @csrf
            <div class="search-form sm:flex justify-center items-center mt-2">
                <div class="search-form--sm flex justify-center items-center">
                    <div class="search-form_area  sm:max-w-md mt-0 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-l-lg">
                        <select class="border-none cursor-pointer" name="form_area" id="form_area">
                            <option value="">All area</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->area }}" @if($area->area == old('form_area')) selected @endif>{{ $area->area }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-form_genre sm:max-w-md mt-0 px-6 py-4 bg-white shadow-md overflow-hidden">
                        <select class="border-none cursor-pointer" name="form_genre" id="form_genre">
                            <option value="">All genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->genre }}" @if($genre->genre == old('form_genre')) selected @endif>{{ $genre->genre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="search-form_search cursor-pointer  flex justify-center items-center sm:max-w-md mt-0 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-r-lg">
                    <label class="search-form_search_label cursor-pointer" for="form_search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </label>
                    <input class="search-form_search_input w-full cursor-pointer border-none" type="search" name="form_search" id="form_search" >
                </div>
            </div>
        </form>
        <div class="shop sm:w-3/4 grid auto-rows-auto xl:grid-cols-4 lg:grid-cols-3 sm:grid-cols-2 gap-x-2 gap-y-4 mt-6 ">
            @foreach($shops as $shop)
            <form action="/detail/{{ $shop->id }}" method="get">
            @csrf
                <div class="shop_card h-96 flex flex-col  sm:rounded-lg shadow-lg">
                    <img src="{{ $shop->pic_url }}" alt="写真" class="shop_eye-catch h-3/5 sm:rounded-t-lg">
                    <p class="shop_desc_shop-name font-extrabold pl-2 py-2">{{ $shop->shop_name }}</p>
                    <div class="shop_card_item_hash flex pl-2">
                    <p class="shop_desc_area">#{{ $shop->area }}</p>
                    <p class="shop_desc_genre">#{{ $shop->genre }}</p>
                    </div>
                    <div class="shop_card_item_button flex items-center justify-around pt-5">
                        <!-- formを書くとボタンで画面遷移 -->
                        <x-primary-button>
                            <p>詳しくみる</p>
                        </x-primary-button>
                        <!-- お気に入りボタンは押したら色が変わるようにする、お気に入りのDBに追加 -->
                        @auth
                        <div class="shop_card_item_favorite-button">
                            <button type="submit" formaction='/favorite' formmethod='post'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                <input type="hidden" name="user_id" id='user_id' value="{{ Auth::id() }}">
                                <input type="hidden" value="{{ $shop->id }}" name="shop_id">
                            </button>
                        </div>
                        @endauth
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</x-app-layout>