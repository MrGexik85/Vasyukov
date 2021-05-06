@extends('templates.default')

@section('content')
    <a href="{{ route('record.new') }}"><button type="button" class="btn btn-secondary btn-lg mt-3">Добавить заявку</button></a>
    @if (!$orders->count())
        <p>Нет активных заявок</p>
    @else
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Обновлено</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->order_name }}</th>
                        <td>{{ $order->status_name }}</td>
                        <td>{{ $order->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection