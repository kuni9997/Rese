<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/bookingList.css') }}">
    @endsection
    <div class="booking-list flex flex-col justify-center items-center">
        <h1 class="title">予約一覧</h1>
        <div class="booking-list__content md:w-3/5">
            <table>
                <tr>
                    <th>店舗名</th>
                    <th>日付</th>
                    <th>時間</th>
                    <th>人数</th>
                    <th></th>
                </tr>
                @foreach($shops as $shop)
                    @foreach($shop->Reservation as $reservation)
                    <form action="/booking/manager/detail/{{$reservation->id}}" method="get">
                    @csrf
                        <tr class="booking-list__item p-2">
                            <td>{{ $shop->shop_name }}</td>
                            <td>{{ date("Y-m-d",strtotime($reservation->reservation_time)) }}</td>
                            <td>{{ date("H:i",strtotime($reservation->reservation_time)) }}</td>
                            <td>{{ $reservation->number }}</td>
                            <td><x-primary-button>予約詳細</x-primary-button></td>
                        </tr>
                    </form>
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>