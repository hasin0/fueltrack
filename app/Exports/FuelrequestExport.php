<?php

namespace App\Exports;

use App\Models\fuelrequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Support\Facades\DB;


use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;


class FuelrequestExport implements
FromQuery,
WithMapping,
ShouldAutoSize,
WithHeadings
{
    use Exportable;
    protected $from;
    protected $to;
    protected $fuelPrice;

    /**
    * @return \Illuminate\Support\Collection
    */


    public function __construct(String $from = null , String $to = null, $fuelPrice = null)
    {
        $this->from = $from;
        $this->to   = $to;
        $this->fuelPrice = $fuelPrice; // Store the passed fuel price

    }





    public function query()
    {
    //    return   fuelrequest::query()->whereDate('created_at', [ $this->from, $this->to ]);//->with(['department'])->get();
       //User::select('*')->where('created_at','>=',$this->from)->where('created_at','<=', $this->to)->with(['department'])->get();

       //  return  dd(User::with(['department'])->get());

       return  fuelrequest::whereBetween(DB::raw('DATE(`created_at`)'),
       [$this->from,$this->to])->with(['vehicles']);
       // return   $users = User::with(['department'])->get();

    }






    public function map($fuelrequests): array
    {



        return [
            $fuelrequests->id,
            $fuelrequests->user->name,
            $fuelrequests->present_km,
            $fuelrequests->previous_km,
            $fuelrequests->ltr_collected,
            $fuelrequests->km_covered,
            $fuelrequests->{'AVG_KM/LTR'}, // Access the column correctly
            'fuel_price' => $this->fuelPrice, // Add fuel price to the array
            $fuelrequests->amount,
            $fuelrequests->department->name,
            $fuelrequests->order_number,
            $fuelrequests->vehicles->pluck('tag_no')->implode(', '),
            $fuelrequests->vehicles->pluck('name')->implode(', '),
            $fuelrequests->vehicles->pluck('fueltank')->implode(', '),
            $fuelrequests->created_at->toDatestring(),
        ];
    //    return [

    //    $fuelrequests->id,

    //      $fuelrequests->user->name,///$fuelrequests->user->phone,


    //    $fuelrequests->present_km,
    //    $fuelrequests->previous_km,
    //    $fuelrequests->ltr_collected,
    //    $fuelrequests->km_covered,
    //    $fuelrequests->AVG_KM/LTR,
    //    $fuelrequests->price,
    //    $fuelrequests->amount,





    //    $fuelrequests->department->name,///$fuelrequests->user->phone,
    //    $fuelrequests->order_number,

    // //    @foreach($ViewsPages->vehicles as $data)($data->department->name)@endforeach,
    // //    $fuelrequests->vehicle()->tag_no,
    // //    $fuelrequests->vehicle()->fueltank,


    //    $fuelrequests->vehicles->pluck('tag_no')->implode(', '),
    //    $fuelrequests->vehicles->pluck('name')->implode(', '),

    //    $fuelrequests->vehicles->pluck('fueltank')->implode(', '),



    //    $fuelrequests->created_at->toDatestring(),


    //    //$fuelrequests->created_at wite time stamps


    //    ];



    }





    /**
    * @return array
    */
   public function registerEvents(): array
   {
       return [
           AfterSheet::class    => function(AfterSheet $event) {
               $cellRange = 'A1:W1'; // All headers
               $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
           },
       ];
   }

    //function header in excel
    public function headings(): array
    {
        return [
            'No',
            'name',
            'present_km',
            'previous_km',
            'ltr_collected',
            'km_covered',
            'AVG_KM/LTR',
            'price',
            'amount',
            'department',
            'order-number',
            'car-tag',
            'name',

            'fueltank',

            'created_at',


       ];
   }




}






// 'HOD_approval',
// 'Admin_approval',
// 'order_number',
// 'Fuel_station_approval',
// 'user_id',
// 'fuelstation_id',
// 'department_id'
