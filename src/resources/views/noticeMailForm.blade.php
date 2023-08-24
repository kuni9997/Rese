<x-guest-layout>
    @section('Add_item')
    <div class="w-full sm:max-w-md mt-0 px-6 py-4 shadow-md overflow-hidden sm:rounded-t-lg bg-blue-600">
        <p class="text-white">お知らせメール送信フォーム</p>
    </div>
    @endsection

    <form method="POST" action="/mail">
        @csrf
        <!-- Email Address -->
        <div class="mt-4 flex justify-center items-center">
            <select name="send-to" id="send-to" type="text">
                <option value="" selected hidden>選択してください</option>
                <option value="user">利用者全員</option>
                <option value="user-shop">店舗利用者</option>
            </select>
        </div>
        @error('send-to')
        <x-input-error :messages="{{$message}}" class="mt-2" />
        @enderror

        <!-- Password -->
        <div class="mt-4 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 mr-4">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
            </svg>

            <x-text-input placeholder="Password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                メール送信
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
