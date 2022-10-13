<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;


class UsersExport implements
FromQuery,
WithMapping,
ShouldAutoSize,
WithHeadings

{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
     // varible form and to
     public function __construct(String $from = null , String $to = null)
     {
         $this->from = $from;
         $this->to   = $to;
     }

     //function select data from database
     public function query()
     {
        return   User::query()->whereDate('created_at', [ $this->from, $this->to ]);//->with(['department'])->get();
        //User::select('*')->where('created_at','>=',$this->from)->where('created_at','<=', $this->to)->with(['department'])->get();

        //  return  dd(User::with(['department'])->get());


        // return   $users = User::with(['department'])->get();

     }


     public function map($users): array
     {

        return [

            $users->id,
            $users->name,

            
            $users->email,
             $users->department->name,
            $users->created_at



        ];



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
             'email',
             'department',
             'created_at',
        ];
    }
}
