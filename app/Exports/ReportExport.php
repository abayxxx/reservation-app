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
        $datas = Order::query()->with(['table', 'jurnalOrder', 'jurnalOrder.menu'])->get();

        // Modify the data to be displayed in the PDF
        foreach ($datas as $key => $value) {
            $data[$key]['created_at'] = $value->created_at->format('Y-m-d H:i:s');
            $data[$key]['total'] = 'Rp. ' . number_format($value->total, 0, ',', '.');

            foreach ($value->jurnalOrder as $k => $v) {
                $data[$key]['jurnalOrder'][$k]['menu']['price'] = 'Rp. ' . number_format($v->total, 0, ',', '.');
            }
        }

        $dataNew = [];

        $menuString = '';
        $jumlahMenu = 0;
        $hargaMenu = 0;

        foreach ($datas as $key => $value) {

            foreach ($value['jurnalOrder'] as $k => $v) {
                $menuString .= $v['menu']['name'] . ', ';
                $jumlahMenu += $v['quantity'];
                $hargaMenu += $v['total'];
            }
            $dataNew[$key]['ID'] = $value['id'];
            $dataNew[$key]['Nama Pelanggan'] = $value['name'];
            $dataNew[$key]['Nomor Meja'] = $value['table_id'];
            $dataNew[$key]['Menu'] = $menuString;
            $dataNew[$key]['Jumlah'] = $jumlahMenu;
            $dataNew[$key]['Total Pesanan'] = "Rp. " . number_format($hargaMenu, 0, ',', '.');
            $dataNew[$key]['Tanggal Pesan'] = $value['created_at'];
        }

        return collect($dataNew);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelanggan',
            'Nomor Meja',
            'Menu',
            'Jumlah',
            'Total Pesanan',
            'Tanggal Pesan',
        ];
    }
}
