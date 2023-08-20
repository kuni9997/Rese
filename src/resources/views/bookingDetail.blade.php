<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/bookingList.css') }}">
    @endsection
    <div class="booking-list flex flex-col justify-center items-center">
        <h1 class="title">予約詳細確認</h1>
        <div class="booking-list__content md:w-3/5">
            <table>
                <tr>
                    <th>予約者名</th>
                    <th>店舗名</th>
                    <th>日付</th>
                    <th>時間</th>
                    <th>人数</th>
                    <th></th>
                </tr>
                <form action="/booking/manager" method="get">
                @csrf
                    <tr class="booking-list__item p-2">
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->shop->shop_name }}</td>
                        <td>{{ date("Y-m-d",strtotime($booking->reservation_time)) }}</td>
                        <td>{{ date("H:i",strtotime($booking->reservation_time)) }}</td>
                        <td>{{ $booking->number }}</td>
                        <td><x-primary-button>予約一覧</x-primary-button></td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
</x-app-layout>