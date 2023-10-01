<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/review.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @endsection

    <div class="items my-12 mx-4 flex flex-col justify-center items-center">
        <div class="main-content flex justify-center items-center">
            <div class="card w-2/5 flex justify-center items-center flex-col">
                <div class="card__guidance my-6">
                    <p class="text-4xl">今回のご利用はいかがでしたか？</p>
                </div>
                <div class="card__content">
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
                                <x-primary-button>
                                    <p>詳しくみる</p>
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="review w-2/5 flex justify-center flex-col text-2xl ml-40">
                <form action="/review" method="post" id="reviewPost" enctype="multipart/form-data">
                @csrf
                    <div class="review__star">
                        <div class="review__star__guidance my-4">
                            <p>体験を評価してください</p>
                        </div>
                        <div class="review__star__content w-2/3">
                            <div class="review__star__content__item w-full flex justify-items-center mb-4">
                                @for($i=1; $i < 6; $i++)
                                <div class="review__star__content__item__img w-full" id="review{{ $i }}-div">
                                    <button onclick="onClick(this.id)" id="review{{ $i }}" class="review__star__content__item__img--button" type="button">
                                        @if($review <> null)
                                            @if($review->review > $i)
                                            <svg xm lns="http://www.w3.org/000/svg" viewBox="0 0 24 24" fill="currentColor" class="yellow w-12 h-12 mr-8">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                            </svg>
                                            <input type="hidden" name="review{{ $i }}" id="review{{ $i }}-input" value="0">
                                            @else
                                            <svg xm lns="http://www.w3.org/000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 mr-8">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                            </svg>
                                            <input type="hidden" name="review{{ $i }}" id="review{{ $i }}-input" value="0">
                                            @endif
                                            @else
                                            <svg xm lns="http://www.w3.org/000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 mr-8">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                            </svg>
                                            <input type="hidden" name="review{{ $i }}" id="review{{ $i }}-input" value="0">
                                        @endif
                                    </button>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="review__text w-2/3">
                        <div class="review__text__guidance my-4">
                            <p>口コミを投稿</p>
                        </div>
                        <div class="review__text__content w-full">
                            <textarea class="resize-none" name="text" id="text" cols="80" rows="5" placeholder="カジュアルな夜のお出かけにおすすめのスポット" value="{{ old('text') }}">{{ old('text') }}</textarea>
                        </div>
                    </div>
                        <div class="review__pic w-full flex justify-items-center flex-col">
                            <div class="review__pic__guidance my-4">
                                <p>画像の追加</p>
                            </div>
                            <div class="review__pic__upload-box">
                                <input class="review__pic__content__image" type="file" name="image" id="image" value="{{ old('image') }}">
                                <span class="text-base">クリックして写真を追加</span><br><span class="text-sm">またはドラッグアンドドロップ</span>
                            </div>
                            <div class="review__pic__content__preview-box">
                                @if($review <> null)
                                <img class="review__pic__content__preview-box__previewImg" src="{{ old('image') }}" alt=""/>
                                @else
                                <img class="review__pic__content__preview-box__previewImg" src="{{ old('image') }}" alt="" hidden/>
                                @endif
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="shop_id" id="shop_id" value="{{ $shop->id }}">
                </form>
            </div>
            <div class="submit-button w-full flex justify-center items-center my-12 ">
                @if($review <> null)
                <button class="submit-button__item w-1/3 bg-white rounded-lg py-2 font-bold" type="submit" form="reviewPost" formaction='/review/update'>口コミを更新</button>
                @else
                <button class="submit-button__item w-1/3 bg-white rounded-lg py-2 font-bold" type="submit" form="reviewPost">口コミを投稿</button>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/review.js') }}"></script>
    <script src="{{ asset('/js/imageDrop.js') }}"></script>
</x-app-layout>