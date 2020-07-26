<style>
    .lds-facebook {
        display: none;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-facebook div {
        display: none;
        position: absolute;
        left: 8px;
        width: 16px;
        background: #cef;
        animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }

    .lds-facebook div:nth-child(1) {
        left: 8px;
        animation-delay: -0.24s;
    }

    .lds-facebook div:nth-child(2) {
        left: 32px;
        animation-delay: -0.12s;
    }

    .lds-facebook div:nth-child(3) {
        left: 56px;
        animation-delay: 0;
    }

    @keyframes lds-facebook {
        0% {
            top: 8px;
            height: 64px;
        }

        50%,
        100% {
            top: 24px;
            height: 32px;
        }
    }
</style>

<div id="print-area">
    <div class="text-center">
        <div class="lds-facebook">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <table class="table table-hover table-bordered">

        <thead>
            <tr>
                <th>@lang('site.name')</th>
                <th>@lang('site.quantity')</th>
                <th>@lang('site.price')</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>{{$product->finalPrice()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>@lang('site.total') <span>{{$order->total_price}}</span></h3>
</div>
<button class="btn btn-info btn-block print-btn">@lang('site.print')</button>