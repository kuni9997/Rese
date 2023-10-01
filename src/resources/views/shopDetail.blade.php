<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shopDetail.css') }}">
    @endsection
    <div class="content w-full md:flex justify-center items-center ">
        <div class="content__item-detail md:w-4/5 md:mx-20 md:my-8">
            <div class="content__item-detail__header flex my-4">
                <div class="content__item-detail__header__img  shadow-xl font-bold rounded bg-white">
                    <form action="/" method="get">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="content__item-detail__header__item w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </form>
                </div>
                <h2 class="content__item-detail__header__shop-name font-extrabold text-xl ml-4">{{$shop_detail->shop_name}}</h2>
            </div>
            <img src="{{ $shop_detail->pic_url }}" alt="写真" class="shop__eye-catch h-3/5">
            <div class="content__item-detail__hash-tags flex my-4">
                <p class="area">#{{$shop_detail->area}}</p>
                <p class="genre">#{{$shop_detail->genre}}</p>
            </div>
            <p class="content__item-detail__desc">{{$shop_detail->shop_desc}}</p>
            <div class="review mt-4">
                @if($user->role ==3)
                    @if($reviewExists)
                        <form action="/review" method="get" id="reviewPost" name="reviewPost">
                        @csrf
                            <input type="hidden" value="{{ $shop_id }}" name="shop_id" id="shop_id" />
                            <input class="review__content__link font-bold underline" type="submit" value="口コミを投稿する">
                        </form>
                        @endif
                        <div class="review__content__list">
                        @if($reviews->isNotEmpty())
                        <h3 class="review__content__list__title w-full bg-blue-400 text-white py-1 my-8 text-center">全ての口コミ情報</h3>
                        @foreach($reviews as $review)
                            <div class="review__content__list__item my-4">
                                <div class="review__content__list__item__link w-full flex flex-row-reverse mt-2">
                                    @if($review->user_id == Auth::id())
                                    <form action="/review/delete" class="review__delete__button">
                                        <button class="font-bold underline mr-4" type="submit" value="{{ $review->id }}" name="review_id" id="review_id">口コミを削除</button>
                                    </form>
                                    <a class="font-bold underline mr-4" href="{{ url('/review') }}">口コミを編集</a>
                                    @elseif(Auth::id() == 1)
                                    <form action="/review/delete" class="review__delete__button">
                                        <button class="font-bold underline mr-4" type="submit" value="{{ $review->id }}" name="review_id" id="review_id">口コミを削除</button>
                                    </form>
                                    @endif
                                </div>
                                <div class="review__content__list__item__user-item ml-8">
                                    <div class="review__content__list__item__user-item__star flex">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($review->review > $i)
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="yellow w-6 h-6">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path str
                                                oke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="review__content__list__item__user-item__comment my-4">
                                        <p>{{ $review->reviewPost->review_text }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="content__item-book bg-blue-600 md:w-4/5  md:mx-20 my-4 text-white flex  justify-between flex-col text-xl md:rounded-lg">
            <h3 class="content__item-book__header m-4">予約</h3>
            <form action="/booking/add" method="post" class="content__item-book__booking m-4">
                @csrf
                <div class="content__item-book__booking--input text-black">
                    <input type="date" name="date" id="date" onchange="textInputFunc(this.value,this.id)">
                    <input type="time" name="time" id="time" onchange="textInputFunc(this.value,this.id)">
                    <input type="number" name="number" id="number" onchange="textInputFunc(this.value,this.id)">
                </div>
                <div class="content__item-book__booking__error">
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    <x-input-error :messages="$errors->get('number')" class="mt-2" />
                </div>
                <div class="content__item-book__detail">
                    <table class="content__item-book__detail--table">
                        <tr>
                            <td>shop</td>
                            <td id="shop-detail">{{$shop_detail->shop_name}}</td>
                            <input type="hidden" name="shop_id" id="shop_id" value="{{$shop_detail->id}}">
                        </tr>
                        <tr>
                            <td>date</td>
                            <td id="date-detail"></td>
                        </tr>
                        <tr>
                            <td>time</td>
                            <td id="time-detail"></td>
                        </tr>
                        <tr>
                            <td>number</td>
                            <td id="number-detail" ></td>
                        </tr>
                    </table>
                    <script>
                        function textInputFunc(value,id){
                            var myId = id + "-detail";
                            var myObj = document.getElementById(myId);
                            if(id=="number"){
                                myObj.innerText = value + "人";
                            }else{
                                myObj.innerText = value;
                            }
                        }
                    </script>
                </div>
                <button class="content__item-book__button w-full bg-blue-700 mb-0 p-4 md:rounded-lg" type="submit">予約する</button>
            </form>
        </div>
    </div>
</x-app-layout>