<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @endsection

    <div class="content flex flex-col justify-center items-center">
        <div class="user-name font-bold text-3xl">
            <p>{{Auth::user()->name}}さん</p>
        </div>
        <div class="content__item w-full md:flex justify-between mt-8 ">
            <div class="content__item__booking max-md:flex justify-center items-center flex-col md:ml-8 md:w-max">
                <p class="title">予約状況</p>
                <?php $counter=1 ?>
                @foreach($bookings as $booking)
                <form action="/booking/delete" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $booking->id }}">
                    <div class="content__item__booking__card w-max bg-blue-600 md:rounded-md text-white shadow-xl mt-4 ">
                        <div class="content__item__booking__card__header flex justify-between">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 m-4">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                            </svg>
                            <p class="m-4">予約{{ $counter++ }}</p>
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-4 ml-32">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                        <table class="content__item__booking__card__table m-4">
                            <tr>
                                <td>Shop</td>
                                <td>{{ $booking->Shop->shop_name }}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td><input class="text-black" type="date" name="date" id="date" value="{{ date("Y-m-d",strtotime($booking->reservation_time)) }}" ></td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td><input class="text-black" type="time" name="time" id="time" value="{{ date("H:i",strtotime($booking->reservation_time)) }}"></td>
                            </tr>
                            <tr>
                                <td>Number</td>
                                <td><input class="input__number text-black" type="number" name="number" id="number" value="{{ $booking->number }}">人
                                </td>
                            </tr>
                        </table>
                        @if(strtotime(date("Y-m-d H:i",strtotime($booking->reservation_time))) <= strtotime(date("Y-m-d H:i")) )
                        <div class="content__item-book__review w-full flex justify-around justify-items-center mb-4">
                            @for($i=1; $i < 6; $i++)
                            <div class="content__item-book__review__item" id="review{{ $i }}-div">
                                <button onclick="onClick(this.id)" id="review{{ $i }}" class="content__item-book__review__item--color" type="button">
                                    <svg xm lns="http://www.w3.org/000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                    </svg>
                                    <input type="hidden" name="review{{ $i }}" id="review{{ $i }}-input" value="0">
                                </button>
                            </div>
                            @endfor
                            <button type="submit" formaction="/booking/review" class="content__item-book__review__item--button bg-yellow-600 md:rounded p-1">評価する</button>
                        </div>
                        @endif
                        <button type="submit" formaction="/payment/index" formmethod="get" class="content__item-book__button w-full bg-green-700 mb-0 p-4">事前決済をする</button>
                        <button type="submit" formaction="/booking/change" class="content__item-book__button w-full bg-blue-700 mb-0 p-4">予約を変更する</button>
                        <button type="submit" formaction="/booking/qrCode" class="content__item-book__button__qr-code w-full bg-red-500 mb-0 p-4 md:rounded-b-lg">QRコード表示</button>
                    </div>
                </form>
                @endforeach
            </div>
            <div class="content__item__favorite md:ml-8 md:mr-8 md:w-3/5 max-md:flex justify-center items-center flex-col max-md:mt-8">
                <p class="title">お気に入り店舗</p>
                <div class="content__item__favorite__card">
                    <div class="shop grid auto-rows-auto lg:grid-cols-3 sm:grid-cols-2 gap-x-2 gap-y-4 mt-6 ">
                        @foreach($favorites as $favorite)
                        <form action="/detail/{{ $favorite->shop->id }}" method="get">
                        @csrf
                            <div class="shop_card h-96 flex flex-col  sm:rounded-lg shadow-lg">
                                <img src="{{ $favorite->shop->pic_url }}" alt="写真" class="shop_eye-catch h-3/5 sm:rounded-t-lg">
                                <p class="shop_desc_shop-name font-extrabold pl-2 py-2">{{ $favorite->shop->shop_name }}</p>
                                <div class="shop_card_item_hash flex pl-2">
                                <p class="shop_desc_area">#{{ $favorite->shop->area }}</p>
                                <p class="shop_desc_genre">#{{ $favorite->shop->genre }}</p>
                                </div>
                                <div class="shop_card_item_button flex items-center justify-around pt-5">
                                    <x-primary-button>
                                        <p>詳しくみる</p>
                                    </x-primary-button>
                                    <div class="shop_card_item_favorite-button">
                                        <button type="submit" formaction='/favorite' formmethod='post'>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-600">
                                            <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                            </svg>
                                            <input type="hidden" name="user_id" id='user_id' value="{{ Auth::id() }}">
                                            <input type="hidden" value="{{ $favorite->shop->id }}" name="shop_id">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/review.js') }}"></script>
</x-app-layout>