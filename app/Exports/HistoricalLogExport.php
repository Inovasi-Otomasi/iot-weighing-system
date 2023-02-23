<?php

namespace App\Exports;

use App\Models\Historical;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Shift;
use App\Models\Sku;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use SebastianBergmann\Type\NullType;

class HistoricalLogExport implements WithEvents, Responsable
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Historical::all();
    // }
    use Exportable;
    private $fileName = 'test.xlsx';
    private $writerType = Excel::XLSX;
    protected $parameter;
    public function __construct($request)
    {
        // $datetimeexplode = explode(' To ', $request->datetimerange2);
        // $start = $datetimeexplode[0];
        // $end = $datetimeexplode[1];
        $this->parameter = [
            'range' => (int)$request->input('range') ?: 1,
            'from' => $request->input('from') ?: NULL,
            'to' => $request->input('to') ?: NULL,
            'line' => $request->input('line') ?: NULL,
            'hmi' => $request->input('hmi') ?: NULL,
            'machine' => $request->input('machine') ?: NULL,
            'shift' => $request->input('shift') ?: NULL,
            'group' => $request->input('group') ?: NULL,
            'sku' => $request->input('sku') ?: NULL,
            'user' => $request->input('user') ?: NULL,
            'pic' => $request->input('pic') ?: NULL,
            'nik' => $request->input('nik') ?: NULL,
            'low' => $request->input('low') ?: NULL,
            'high' => $request->input('high') ?: NULL,
            'status' => $request->input('status') ?: NULL,
            'qc_field' => $request->input('qc_field') ?: NULL,
            'qc_head' => $request->input('qc_head') ?: NULL,
            'working_date' => $request->input('working_date') ?: NULL,
        ];
        $this->getWorkingDate();
        $this->fileName = ($this->parameter['working_date'] ?: ($this->getWorkingDate() ?: 'All')) . '_' . ($this->parameter['shift'] ?: 'All') . '_' . ($this->parameter['group'] ?: 'All') . '_' . ($this->parameter['sku'] ?: 'All') . '.xlsx';
    }

    public function getWorkingDate()
    {
        $parameters_log = new Historical();
        if ($this->parameter['line']) {
            $parameters_log = $parameters_log->where('line_name', $this->parameter['line']);
        }
        if ($this->parameter['hmi']) {
            $parameters_log = $parameters_log->where('hmi_name', $this->parameter['hmi']);
        }
        if ($this->parameter['machine']) {
            $parameters_log = $parameters_log->where('machine_name', $this->parameter['machine']);
        }
        if ($this->parameter['shift']) {
            $parameters_log = $parameters_log->where('shift_name', $this->parameter['shift']);
        }
        if ($this->parameter['group']) {
            $parameters_log = $parameters_log->where('shift_group', $this->parameter['group']);
        }
        if ($this->parameter['sku']) {
            $parameters_log = $parameters_log->where('sku_name', $this->parameter['sku']);
        }
        if ($this->parameter['user']) {
            $parameters_log = $parameters_log->where('user', $this->parameter['user']);
        }
        if ($this->parameter['pic']) {
            $parameters_log = $parameters_log->where('pic', $this->parameter['pic']);
        }
        if ($this->parameter['nik']) {
            $parameters_log = $parameters_log->where('nik', $this->parameter['nik']);
        }
        if ($this->parameter['low']) {
            $parameters_log = $parameters_log->where('weight', '>=', $this->parameter['low']);
        }
        if ($this->parameter['high']) {
            $parameters_log = $parameters_log->where('weight', '<=', $this->parameter['high']);
        }
        if ($this->parameter['working_date']) {
            $parameters_log = $parameters_log->where('working_date', $this->parameter['working_date']);
        }
        if ($this->parameter['from'] && $this->parameter['to']) {
            $from = date("Y-m-d H:i:s", $this->parameter['from']);
            $to = date("Y-m-d H:i:s", $this->parameter['to']);
            $parameters_log = $parameters_log->where([
                ['created_at', '>=', $from], ['created_at', '<=', $to]
            ])->latest()->get();
        } elseif ($this->parameter['range']) {
            $parameters_log = $parameters_log->where('created_at', '>=', Carbon::now()->subDays($this->parameter['range']))->latest()->get();
        }
        $latest_working_date = $parameters_log->take(1)->first() ? $parameters_log->take(1)->first()->working_date : null;
        // ddd($latest_working_date);
        return $latest_working_date;
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setWorksheet();
    //     // $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(storage_path('mayora.png'));
    //     // $drawing->setHeight(90);
    //     $drawing->setResizeProportional(TRUE);
    //     $drawing->setCoordinates('A1');
    //     return $drawing;
    // }

    public function getDrawing()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(storage_path('mayora-logo.png'));
        $drawing->setHeight(100);
        // $drawing->setWidth(200);
        $drawing->setOffsetX(65);
        $drawing->setOffsetY(10);
        $drawing->setResizeProportional(TRUE);
        $drawing->setCoordinates('A1');
        return $drawing;
    }
    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function (BeforeWriting $event) {

                // $drawing = new Drawing;
                // $drawing->setName('Logo');
                // $drawing->setDescription('This is my logo');
                // $drawing->setPath(storage_path('mayora-logo.png'));
                // // $drawing->setHeight(90);
                // $drawing->setResizeProportional(TRUE);
                // // $drawing->setHeight(90);
                // $drawing->setCoordinates('A1');
                $templateFile = new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path('template.xlsx'));
                // $templateFile = new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path('users.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                // $sheet = $event->writer->getSheetByName('DOWNTIME RECORD');
                $sheet = $event->writer->getSheetByIndex(3);
                $workSheet =  $sheet->getDelegate();
                $this->getDrawing()->setWorksheet($workSheet);
                $this->populateSheet($sheet, 'OVER');

                $sheet = $event->writer->getSheetByIndex(2);
                $workSheet =  $sheet->getDelegate();
                $this->getDrawing()->setWorksheet($workSheet);
                $this->populateSheet($sheet, 'UNDER');

                $sheet = $event->writer->getSheetByIndex(1);
                $workSheet =  $sheet->getDelegate();
                $this->getDrawing()->setWorksheet($workSheet);
                $this->populateSheet($sheet, 'PASS');

                $sheet = $event->writer->getSheetByIndex(0);
                $workSheet =  $sheet->getDelegate();
                $this->getDrawing()->setWorksheet($workSheet);
                $this->populateSheet($sheet, NULL);

                $event->writer->getSheetByIndex(0)->export($event->getConcernable()); // call the export on the first sheet

                return $event->getWriter()->getSheetByIndex(0);
            },
            // AfterSheet::class => function (AfterSheet $event) {
            //     $workSheet =  $event->sheet->getDelegate();
            //     ddd($workSheet);
            //     $this->getDrawing()->getWorksheet($workSheet);
            // },
        ];
    }
    private function populateSheet($sheet, $status)
    {
        // $sheet->getColumnDimension('A')->setWidth(200);
        $sheet->getRowDimension('1')->setRowHeight(70);

        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $numrow = 4;
        // Populate the static cells
        // $sheet->mergeCells('A1:Q2');
        $sheet->setCellValue('A3', "CREATED AT");
        $sheet->setCellValue('B3', "WORKING DATE");
        $sheet->setCellValue('C3', "SHIFT");
        $sheet->setCellValue('D3', "GROUP");
        $sheet->setCellValue('E3', "LINE");
        $sheet->setCellValue('F3', "HMI");
        $sheet->setCellValue('G3', "MACHINE");

        // $sheet->setCellValue('G3', "START");
        // $sheet->setCellValue('H3', "END");
        $sheet->setCellValue('H3', "SKU");
        $sheet->setCellValue('I3', "TARGET");
        $sheet->setCellValue('J3', "WEIGHT");

        // $sheet->setCellValue('L3', "THRESHOLD HIGH");
        // $sheet->setCellValue('M3', "THRESHOLD LOW");
        $sheet->setCellValue('K3', "STATUS");
        $sheet->setCellValue('L3', "USER");
        $sheet->setCellValue('M3', "PIC");
        $sheet->setCellValue('N3', "NIK");
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);
        $sheet->getStyle('L3')->applyFromArray($style_col);
        $sheet->getStyle('M3')->applyFromArray($style_col);
        $sheet->getStyle('N3')->applyFromArray($style_col);
        // $sheet->getStyle('N3')->applyFromArray($style_col);
        // $sheet->getStyle('O3')->applyFromArray($style_col);
        // $sheet->getStyle('P3')->applyFromArray($style_col);
        // $sheet->getStyle('Q3')->applyFromArray($style_col);
        //query
        // $proxy = Historical::all();
        $parameters_log = new Historical();
        if ($this->parameter['line']) {
            $parameters_log = $parameters_log->where('line_name', $this->parameter['line']);
        }
        if ($this->parameter['hmi']) {
            $parameters_log = $parameters_log->where('hmi_name', $this->parameter['hmi']);
        }
        if ($this->parameter['machine']) {
            $parameters_log = $parameters_log->where('machine_name', $this->parameter['machine']);
        }
        if ($this->parameter['shift']) {
            $parameters_log = $parameters_log->where('shift_name', $this->parameter['shift']);
        }
        if ($this->parameter['group']) {
            $parameters_log = $parameters_log->where('shift_group', $this->parameter['group']);
        }
        if ($this->parameter['sku']) {
            $parameters_log = $parameters_log->where('sku_name', $this->parameter['sku']);
        }
        if ($this->parameter['user']) {
            $parameters_log = $parameters_log->where('user', $this->parameter['user']);
        }
        if ($this->parameter['pic']) {
            $parameters_log = $parameters_log->where('pic', $this->parameter['pic']);
        }
        if ($this->parameter['nik']) {
            $parameters_log = $parameters_log->where('nik', $this->parameter['nik']);
        }
        if ($this->parameter['low']) {
            $parameters_log = $parameters_log->where('weight', '>=', $this->parameter['low']);
        }
        if ($this->parameter['high']) {
            $parameters_log = $parameters_log->where('weight', '<=', $this->parameter['high']);
        }
        if ($status) {
            $parameters_log = $parameters_log->where('status', $status);
        }
        if ($this->parameter['working_date']) {
            $parameters_log = $parameters_log->where('working_date', $this->parameter['working_date']);
        }
        if ($this->parameter['from'] && $this->parameter['to']) {
            $from = date("Y-m-d H:i:s", $this->parameter['from']);
            $to = date("Y-m-d H:i:s", $this->parameter['to']);
            $parameters_log = $parameters_log->where([
                ['created_at', '>=', $from], ['created_at', '<=', $to]
            ])->latest()->get();
        } elseif ($this->parameter['range']) {
            $parameters_log = $parameters_log->where('created_at', '>=', Carbon::now()->subDays($this->parameter['range']))->latest()->get();
        }


        // $this->fileName = ($this->parameter['working_date'] ?: 'All') . '_' . ($this->parameter['shift'] ?: 'All') . '_' . ($this->parameter['group'] ?: 'All') . '_' . ($this->parameter['sku'] ?: 'All') . '.xlsx';

        foreach ($parameters_log as $row) {
            // $sheet->setCellValue('B' . $numrow, $row->line_name);
            $sheet->setCellValue('A' . $numrow, $row->created_at);
            $sheet->setCellValue('B' . $numrow, $row->working_date);
            $sheet->setCellValue('C' . $numrow, $row->shift_name);
            $sheet->setCellValue('D' . $numrow, $row->shift_group);
            $sheet->setCellValue('E' . $numrow, $row->line_name);
            $sheet->setCellValue('F' . $numrow, $row->hmi_name);
            $sheet->setCellValue('G' . $numrow, $row->machine_name);

            // $sheet->setCellValue('G' . $numrow, $row->shift_start);
            // $sheet->setCellValue('H' . $numrow, $row->shift_end);
            $sheet->setCellValue('H' . $numrow, $row->sku_name);
            $sheet->setCellValue('I' . $numrow, $row->target);
            $sheet->setCellValue('J' . $numrow, $row->weight);

            // $sheet->setCellValue('L' . $numrow, $row->th_H);
            // $sheet->setCellValue('M' . $numrow, $row->th_L);
            $sheet->setCellValue('K' . $numrow, $row->status);
            $sheet->setCellValue('L' . $numrow, $row->user);
            $sheet->setCellValue('M' . $numrow, $row->pic);
            $sheet->setCellValue('N' . $numrow, $row->nik);
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            // $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            // $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            // $sheet->getStyle('P' . $numrow)->applyFromArray($style_row);
            // $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $numrow++;
        };
        // $sheet->getColumnDimension('A')->setAutoSize(true);
        // $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setWidth(30);
        $sheet->getColumnDimension('N')->setWidth(30);
        // $sheet->getColumnDimension('N')->setAutoSize(true);
        // $sheet->getColumnDimension('O')->setAutoSize(true);
        // $sheet->getColumnDimension('P')->setAutoSize(true);
        // $sheet->getColumnDimension('Q')->setAutoSize(true);


        $numrow += 3;
        $sheet->setCellValue('M' . $numrow, 'Dilaporkan oleh');
        $sheet->setCellValue('N' . $numrow, 'Diketahui oleh');
        $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
        $numrow++;
        $sheet->mergeCells('M' . $numrow . ':M' . $numrow + 2);
        $sheet->mergeCells('N' . $numrow . ':N' . $numrow + 2);
        $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('M' . $numrow + 1)->applyFromArray($style_row);
        $sheet->getStyle('N' . $numrow + 1)->applyFromArray($style_row);
        $sheet->getStyle('M' . $numrow + 2)->applyFromArray($style_row);
        $sheet->getStyle('N' . $numrow + 2)->applyFromArray($style_row);
        $numrow += 3;
        $sheet->setCellValue('M' . $numrow, 'Nama: ' . $this->parameter['qc_field'] ?: '');
        $sheet->setCellValue('N' . $numrow, 'Nama: ' . $this->parameter['qc_head'] ?: '');
        $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
        // $sheet->getColumnDimension('A')->setAutoSize(true);
        // $sheet->getColumnDimension('B')->setAutoSize(true);
        $numrow++;
        $sheet->setCellValue('M' . $numrow, 'QC Field');
        $sheet->setCellValue('N' . $numrow, 'QC Unit Head');
        $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
    }
}
