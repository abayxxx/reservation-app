<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $datas = Order::all();

        // Modify the data to be displayed in the PDF
        $datas->map(function ($data) {
            $data['price'] = 'Rp. ' . number_format($data->menu->price, 0, ',', '.');
            $data['total'] = 'Rp. ' . number_format($data->total, 0, ',', '.');
            $data['created_at'] = $data->created_at->format('Y-m-d H:i:s');
            $data['table_id'] = $data->table->number;
            $data['menu_id'] = $data->menu->name;


            unset($data['updated_at']);

            return $data;
        });

        $dataNew = [];

        foreach ($datas as $data) {
            $dataNew[] = [
                'id' => $data->id,
                'name' => $data->name,
                'menu' => $data->menu_id,
                'table' => $data->table_id,
                'quantity' => $data->quantity,
                'price' => $data->price,
                'total' => $data->total,
                'created_at' => $data->created_at,
            ];
        }

        return collect($dataNew);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelanggan',
            'Menu',
            'Nomor Meja',
            'Jumlah',
            'Harga Menu',
            'Total Pesanan',
            'Tanggal Pesan',
        ];
    }
}
