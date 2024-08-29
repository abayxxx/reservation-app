<!DOCTYPE html>
<html>

<head>
    <title>Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .content {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .details {
            margin-bottom: 20px;
        }

        .details div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }


        .total {
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="content">
        <h1>Detail Transaksi</h1>
        <hr>
        <div class="details">
            <div>
                <span class="total">Nama Pelanggan:</span>
                <span>{{ $data->name }}</span>
            </div>
            <div>
                <span class="total">Nomor Meja:</span>
                <span>{{ $data->table_id }}</span>
            </div>
            <div>
                <span class="total">Detail Menu:</span>
                <br>
                @foreach($data->jurnalOrder as $jurnal)
                <span>Nama Menu: {{ $jurnal->menu->name }}</span>
                <br>
                <span>Harga: {{ $jurnal->menu->price }}</span>
                <br>
                @endforeach
            </div>
            <div>
                <span class="total">Jumlah Menu:</span>
                <span>{{ count($data->jurnalOrder) }}</span>
            </div>
            <div>
                <span class="total">Tanggal Transaksi:</span>
                <span>{{ $data->created_at }}</span>
            </div>
            <hr>
            <div>
                <span class="total">Total:</span>
                <span>{{ $data->total }}</span>
            </div>
        </div>
    </div>
</body>

</html>