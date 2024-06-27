<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class ClientDetailsExport implements FromCollection, WithHeadings,WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Primary Client',
            'Name',
            'Address1',
            'Address2',
            'Address3',
            'City',
            'State',
            'Pin',
            'Currency',
            'Client Source',
            'Print',
            'Web',
            'Region',
            'Billing Cycle',
            'Billing Date',
            'Billing Rate',
            'Sector',
            'Start Date',
            'End Date',
            'Type',
            'Broadcast',

        ];
    }
    public function styles(Worksheet $sheet)
    {
        // Get the number of columns dynamically based on headings
        $lastColumn = count($this->headings());

        // Define the range dynamically based on the number of columns
        $range = 'A1:' . $sheet->getHighestColumn() . '1';

        // Set horizontal alignment for the entire range of headings
        $sheet->getStyle($range)->getAlignment()->setHorizontal('center');
        
        // You can set other styles as needed, for example:
        // $sheet->getStyle($range)->getFont()->setBold(true);

        // Adjust column widths dynamically if necessary
        // Example:
        // $sheet->getColumnDimension('B')->setWidth(20);
    }
}
