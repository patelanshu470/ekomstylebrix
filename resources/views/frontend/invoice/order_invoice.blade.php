<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th,
        td {
            text-align: left;
        }
        th {
            background-color: #417394;
            color: white;
        }
        .fullPadding {
            padding: 0;
        }
        .invoice-logo {
            width: 150px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            padding: 10px 30px;
        }
        .invoice-header h2 {
            font-family: sans-serif;
        }
        .invoice-items1 {
            table-layout: fixed;
            width: 100%;
            border-bottom: 1px solid #B3C1D3;
            padding-bottom: 15px;
        }
        .invoice-details {
            background-color: #E4E9EF;
            width: 100%;
            padding: 0 30px;
        }
        .invoice-details p {
            font-size: 20px;
            font-family: sans-serif;
        }
        .address-container {
            display: flex;
        }
        .address {
            padding-left: 30px;
            color: #8D8D8D;
            font-family: sans-serif;
        }
        .from-add-header {
            padding-bottom: 10px;
            padding-top: 20px;
            padding-left: 30px;
        }
        .to-add-header {
            padding-bottom: 10px;
            padding-right: 30px;
            padding-top: 20px;
            font-family: sans-serif;
        }
        .address_to {
            padding-right: 30px;
            color: #8D8D8D;
            font-family: sans-serif;
        }
        .invoice-items {
            width: 100%;
            background-color: rgba(179, 193, 211, 0.15);
            border: 1px solid #B3C1D3;
        }
        .invoice-items th,
        .invoice-items td {
            border-bottom: 1px solid #B3C1D3;
            border-right: 1px solid #B3C1D3;
        }
        .invoice-items p {
            font-family: sans-serif;
        }
        .subtotal {
            text-align: end;
            font-size: 18px;
            font-family: sans-serif;
            font-weight: 600;
            padding-right: 10px;
        }
        .grand-total {
            font-size: 18px;
            font-family: sans-serif;
            font-weight: 600;
        }
        span {
            margin: 10px;
        }
    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0" margin="0" padding="0">
        <tbody>
            <tr>
                <td>
                    <table border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="table-layout: fixed; width: 100%; padding:10px 30px;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="{{ public_path('styleBrix.png') }}" alt="logo-invoice"
                                                        class="invoice-logo">
                                                </td>
                                                <td style="text-align: right;">
                                                    <h2>Invoice</h2>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="invoice-details">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span>Order Id: #{{ $orders->unique_no }}</span> <br>
                                                    <span>Transaction Id : <strong>{{ $payment->transaction_id }}
                                                        </strong></span>
                                                </td>
                                                <td style="text-align: right;">
                                                    <span>Date: {{ date('d/m/Y', strtotime($orders->delivered_at)) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="invoice-items1">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="from-add-header">
                                                        <strong
                                                            style="text-transform: uppercase; font-family: sans-serif;">From</strong>
                                                    </div>
                                                    <div class="address">
                                                        Vacuity Pvt. Ltd. <br>
                                                        414-415 MBC<br>
                                                        Lajamni Chowk, opp. Opera Business Hub,<br>
                                                        Mota Varachha, Surat, Gujarat 394101
                                                    </div>

                                                </td>
                                                <td style="text-align: right;">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="to-add-header">
                                                                <strong style="text-transform: uppercase;">Billing
                                                                    Address</strong>
                                                            </div>
                                                            <div class="address_to">
                                                                {{ $orders->shipping_name }} <br>
                                                                {{ $orders->shipping_address }},<br>
                                                                {{ $orders->shipping_city }},{{ $orders->shipping_landmark }}<br>
                                                                {{ $orders->shipping_state }},{{ $orders->shipping_country }},{{ $orders->shipping_pincode }}
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="to-add-header">
                                                                <strong style="text-transform: uppercase;">Shipping
                                                                    Address</strong>
                                                            </div>
                                                            <div class="address_to">
                                                                {{ $orders->shipping_name }} <br>
                                                                {{ $orders->shipping_address }},<br>
                                                                {{ $orders->shipping_city }},{{ $orders->shipping_landmark }}<br>
                                                                {{ $orders->shipping_state }},{{ $orders->shipping_country }},{{ $orders->shipping_pincode }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="invoice-items">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span>Product-Name</span>
                                                </th>
                                                <th>
                                                    <span>Price</span>
                                                </th>
                                                <th>
                                                    <span>Qty.</span>
                                                </th>
                                                <th>
                                                    <span>Discount</span>
                                                </th>
                                                <th>
                                                    <span>Amount</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($productOrder as $product)
                                                <tr>
                                                    <td>
                                                        <span>{{ $product->product->name }}</span>
                                                    </td>
                                                    <td>
                                                        <span>${{ $product->sell_price }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $product->quantity }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($product->discount)
                                                            <span>${{ $product->discount }}</span>
                                                        @else
                                                            <span>N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span>${{ $product->payable_amount }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="subtotal" style="text-align: right;">
                                                    <span>Subtotal:</span>
                                                </td>
                                                <td>
                                                    <span>${{ $orders->subtotal }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="subtotal" style="text-align: right;">
                                                    <span>Discount:</span>
                                                </td>
                                                <td>
                                                    <span>${{ $orders->total_discount }}</span>
                                                </td>
                                            </tr>
                                            @if ($orders->coupon_amount)
                                                <tr>
                                                    <td colspan="4" class="subtotal" style="text-align: right;">
                                                        <span>Coupon-Discount:</span>
                                                    </td>
                                                    <td>
                                                        <span>${{ $orders->coupon_amount }}</span>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="4" class="subtotal" style="text-align: right;">
                                                    <span>Grand Total</span>
                                                </td>
                                                <td>
                                                    <span>${{ $orders->grand_total }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
</body>
</html>
