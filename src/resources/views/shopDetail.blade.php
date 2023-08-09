<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @endsection
    <div class="content w-full md:flex justify-center items-center ">
        <div class="content__item-detail md:w-4/5 md:mx-20 md:my-20">
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