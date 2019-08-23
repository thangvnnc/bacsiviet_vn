<div class="payment-choice">
    <h3>Deposit money into account</h3>
    <ul class="payment-amount">
        <li>
            <form action="{{route('en-naptien')}}" method="get" accept-charset="utf-8">
                <input type="hidden" name="total_amount" value="50000">
                <button type="submit">VND 50.000</button>
            </form></li>
        <li>
            <form action="{{route('en-naptien')}}" method="get" accept-charset="utf-8">
                <input type="hidden" name="total_amount" value="100000">
                <button type="submit">VND 100.000</button>
            </form>
        </li>
        <li>
            <form action="{{route('en-naptien')}}" method="get" accept-charset="utf-8">
                <input type="hidden" name="total_amount" value="200000">
                <button type="submit">VND 200.000</button>
            </form>
        </li>
    </ul>
</div>
<style>
    .payment-choice{
        padding: 20px;
        margin-bottom: 20px;
    }
    .payment-amount{
    }
    .payment-amount li{
        max-width: 33%;
        float: left;
        padding: 0 5px;
    }
</style>