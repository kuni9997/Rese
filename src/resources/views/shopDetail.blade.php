<x-app-layout>
    <div class="content w-full sm:flex justify-center items-center">
        <div class="content_item-detail md:w-4/5 md:mx-20 md:my-20">
            <div class="content_item-detail_header flex my-4">
                <div class="content_item-detail_header_img  shadow-xl font-bold rounded bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="content_item-detail_header_item w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>
                <h2 class="content_item-detail_header_shop-name font-extrabold text-xl ml-4">{{$shop_detail->shop_name}}</h2>
            </div>
            <img src="{{ $shop_detail->pic_url }}" alt="写真" class="shop_eye-catch h-3/5">
            <div class="content_item-detail_hash-tags flex my-4">
                <p class="area">#{{$shop_detail->area}}</p>
                <p class="genre">#{{$shop_detail->genre}}</p>
            </div>
            <p class="content_item-detail_desc">{{$shop_detail->shop_desc}}</p>
        </div>
        <div class="content_item-book bg-blue-500 w-4/5  mx-20 my-4">
            <h3 class="content_item-book_header">予約</h3>
            <form action="" class="content_item-book_booking">
                @csrf
                <input type="date" name="date" id="date" onchange="textInputFunc(this.value,this.id)">
                <input type="time" name="time" id="time" onchange="textInputFunc(this.value,this.id)">
                <input type="number" name="number" id="number" onchange="textInputFunc(this.value,this.id)">
                <div class="content_item-book_detail">
                    <table class="content_item-book_detail--table">
                        <tr>
                            <td>shop</td>
                            <td id="shop-detail">{{$shop_detail->shop_name}}</td>
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
                            <td id="number-detail"></td>
                        </tr>
                    </table>
                    <script>
                        function textInputFunc(value,id){
                            var myid = id + "-detail";
                            var myobj = document.getElementById(myid);
                            if(id=="number"){
                                myobj.innerText = value + "人";
                            }else{
                                myobj.innerText = value;
                            }
                        }
                    </script>
                </div>
                <button type="submit">予約する</button>
            </form>
        </div>
    </div>
</x-app-layout>