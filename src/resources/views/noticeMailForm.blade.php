<x-guest-layout>
    @section('Add_item')
    <div class="w-full sm:max-w-md mt-0 px-6 py-4 shadow-md overflow-hidden sm:rounded-t-lg bg-blue-600">
        <p class="text-white">お知らせメール送信フォーム</p>
    </div>
    @endsection

    <form method="get" action="/mail">
        @csrf
        <!-- Email Address -->
        <div class="mt-4 flex items-center">
            <label class="mr-8" for="sendTo">送信先</label>
            <select name="sendTo" id="sendTo" type="text">
                <option value="" selected hidden>選択してください</option>
                <option value="user">利用者全員</option>
            </select>
        </div>
        @error('sendTo')
            <p class='text-sm text-red-600 space-y-1'>{{$message}}</p>
        @enderror

        <!-- Password -->
        <div class="mt-4 flex  items-center">
            <label class="w-max whitespace-nowrap mr-4" for="text">メール本文</label>
            <textarea name="text" id="text" cols="40" rows="8"></textarea>
        </div>
        @error('text')
            <p class='text-sm text-red-600 space-y-1'>{{$message}}</p>
        @enderror


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                メール送信
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
