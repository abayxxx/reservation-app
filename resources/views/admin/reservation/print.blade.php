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
        <h1>Detail Reservasi</h1>
        <hr>
        <div class="details">
            <div>
                <span class="total">Nomor Meja:</span>
                <span>{{ $data->table_id }}</span>
            </div>
            <div>
                <span class="total">Tanggal Reservasi:</span>
                <span>{{ $data->date }}</span>
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