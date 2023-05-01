<?php

namespace App\Exports;

use App\Enums\StatusOrderEnum;
use App\Enums\TypeSizeEnum;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class OrderExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithCustomStartCell
{

    private $order;
    private $orderDetail;
    private $index;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($order, $orderDetail)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->index = 0;
    }
    public function collection()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        return $this->orderDetail;
    }
    public function map($data): array
    {
        $this->index++;
        // dd($data);
        return [
            $this->index,
            $data->productName,
            $data->size . ' ' . TypeSizeEnum::getName($data->type_size),
            $data->count,
            $data->price,
            $data->totalPriceProduct
        ];
    }
    public function headings(): array
    {
        return [
            'TT',
            'TÊN HÀNG',
            'KÍCH CỠ',
            'SỐ LƯỢNG',
            'ĐƠN GIÁ',
            'THÀNH TIỀN',
        ];
    }
    public function startCell(): string
    {
        return 'A8';
    }
    public function registerEvents(): array
    {
        // dd($this->data->count());
        $count = $this->order['quantity'];
        $name = $this->order['name'];
        $address = $this->order['address'];
        $discount = $this->order['dicountPrice'];
        $price = $this->order['total_price'];
        return [AfterSheet::class => function (AfterSheet $event) use ($count, $name, $address, $price, $discount) {
            $default_font_style = [
                'font' => [
                    'name' => 'Times New Roman', 'size' => 12, 'color' => ['argb' => '#FFFFFF'],
                    'background' => [
                        'color' => '#5B9BD5'
                    ]
                ]
            ];

            $active_sheet = $event->sheet->getDelegate();
            $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);
            $arrayAlphabet = [
                'A', 'B', 'C'
            ];
            foreach ($arrayAlphabet as $alphabet) {
                $event->sheet->getColumnDimension($alphabet)->setAutoSize(true);
            };
            $cellRange = 'A1:E1';
            $active_sheet->mergeCells($cellRange);
            $active_sheet->getStyle($cellRange)->getFont()->setBold(true);
            $active_sheet->getStyle($cellRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $active_sheet->setCellValue('A1', 'ĐỒ GIA DỤNG');
            $active_sheet->mergeCellsByColumnAndRow(1, 2, 5, 3)->getStyle('A2:E2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
            $active_sheet->getStyle('A2:E2')->getFont()->setBold(true);
            $active_sheet->setCellValue('A2', 'HÓA ĐƠN BÁN HÀNG');
            $active_sheet->mergeCells('A5:C5');
            $active_sheet->setCellValue('A5', 'Tên Khách Hàng: ' . $name);
            $active_sheet->mergeCells('A6:C6');
            $active_sheet->setCellValue('A6', 'Địa Chỉ: ' . $address);
            $endRange = "A$count:E$count";
            $active_sheet->mergeCells($endRange);
            $active_sheet->setCellValue("A$count", 'Tổng Tiền: ' . (floatval($price) - floatval($discount)) . ' - ' . 'Khuyến Mại: ' . $discount);
            $active_sheet->getStyle($endRange)->getFont()->setBold(true);
        },];
    }
}
