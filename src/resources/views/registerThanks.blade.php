<x-app-layout>
    <div class="w-full flex flex-col sm:justify-center items-center pt-24">
        <div class="w-full flex flex-col sm:justify-center items-center sm:max-w-md mt-0 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg h-48 ">
            <p class="text-center text-lg font-bold font-sans">会員登録ありがとうございます。</p>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <x-primary-button class="ml-3 mt-12">
                    <p>ログインする</p>
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>