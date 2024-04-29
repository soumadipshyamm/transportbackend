
@foreach ($orders as $order)
{{-- @dd($orders); --}}
<tr class="manage-enable">
    <input type="hidden" name="orderId[]" value="{{ $order->id }}">
    <td>
        <p>#{{ $order->id }}</p>
    </td>
    <td>
        <p>{{ $order->vehical->car_number }}</p>
    </td>
    <td>
        <p>{{ $order->vehical->type }}</p>
    </td>
    <td>
        <p>{{ $order->clients->name }}</p>
    </td>
    <td>
       <p>{{ $order->clients->phone }}</p>
    </td>
    <td>
        <p>{{ $order->car_date }}</p>
    </td>
    <td>
        <p>{{ $order->in_time }}</p>
    </td>
    <td>
        <p>{{ $order->out_time }}</p>
    </td>
</tr>
@endforeach
