<?php

namespace App\Http\Controllers;

use App\Models\fuelrequest;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\department;
use App\Models\Setting;



use App\Exports\FuelrequestExport;
use App\Models\Fuelstation;
use PDF;
// use Solana\Web3\Connection;
// use Solana\Transaction;
// use Solana\SystemProgram;
// use Solana\Web3\PublicKey;
// use Solana\Web3\LAMPORTS_PER_SOL;



use Illuminate\Http\Request;


class FuelrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct()
    {
         $this->middleware('permission:fuelrequests-list|fuelrequests-create|fuelrequests-edit|fuelrequests-delete', ['only' => ['index','show']]);
         $this->middleware('permission:fuelrequests-create', ['only' => ['create','store']]);
         $this->middleware('permission:fuelrequests-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:fuelrequests-delete', ['only' => ['destroy']]);
         $this->middleware('permission:fuelrequests-AdminStatus', ['only' => ['AdminStatus']]);
         $this->middleware('permission:fuelrequests-HodStatus', ['only' => ['HodStatus']]);
         $this->middleware('permission:fuelrequests-FSAStatus', ['only' => ['FSAStatus']]);



    }





    public function index(Request $request)
    {


        $fuelPrice = Setting::where('key', 'fuel_price')->first(); // Fetch from settings table

        $searchTerm = $request->input('search');



        $fuelrequests = Fuelrequest::with(['vehicles', 'user', 'fuelstation'])
        ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->whereHas('vehicles', function ($q) use ($searchTerm) {
                $q->where('plate_no', 'like', '%' . $searchTerm . '%')
                  ->orWhere('tag_no', 'like', '%' . $searchTerm . '%');
            });
        })
        ->get();


        // $fuelrequests = Fuelrequest::with('vehicles')->get();


        // $fuelrequests = Fuelrequest::with('user')->get(); // Make sure this query works
    return view('backend.layouts.fuelrequests.index', compact('fuelrequests','fuelPrice'));
        // $fuelrequest=fuelrequest::orderBy('id','DESC')->paginate(10);
        // return view('backend.layouts.fuelrequests.index')->with('fuelrequest',$fuelrequest);
    }


// In your FuelRequestController
public function adminStatus(Request $request)
{
    $fuelrequest = Fuelrequest::find($request->id);
    $fuelrequest->Admin_approval = $request->mode == 'true' ? 'active' : 'inactive';
    $fuelrequest->save();
    return response()->json(['msg'=>'Admin approval updated successfully','status'=>true]);
}

// Similar methods for hodStatus and fsaStatus


    // public function AdminStatus(Request $request)
    // {
    //     if ($request->mode == 'true') {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Admin_approval'=>'active']);
    //     } else {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Admin_approval'=>'inactive']);
    //     }

    //     return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    // }


    public function hodStatus(Request $request)
    {
        $fuelrequest = Fuelrequest::find($request->id);
        $fuelrequest->HOD_approval = $request->mode == 'true' ? 'active' : 'inactive';
        $fuelrequest->save();
        return response()->json(['msg'=>'HOD approval updated successfully','status'=>true]);
    }



    // public function HodStatus(Request $request)
    // {
    //     if ($request->mode == 'true') {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['HOD_approval'=>'active']);
    //     } else {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['HOD_approval'=>'inactive']);
    //     }

    //     return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    // }





    // public function FSAStatus(Request $request)
    // {
    //     if ($request->mode == 'true') {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Fuel_station_approval'=>'issued']);
    //     } else {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Fuel_station_approval'=>'Notissued']);
    //     }

    //     return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    // }

    public function fsaStatus(Request $request)
    {
        $fuelrequest = Fuelrequest::find($request->id);
        $fuelrequest->Fuel_station_approval = $request->mode == 'true' ? 'issued' : 'Notissued';
        $fuelrequest->save();
        return response()->json(['msg'=>'Fuel station approval updated successfully','status'=>true]);
    }
































    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department=department::all();
        $vehicle=Vehicle::where('status','active')->get();
        $fuelstation=Fuelstation::all();

        return view('backend.layouts.fuelrequests.create')->with('vehicle',$vehicle)->with('fuelstation',$fuelstation)->with('department',$department);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'present_km'=>'numeric|required',
            'ltr_collected'=>'numeric|required',
            'previous_km'=>'numeric|required',
            // 'amount'=>'numeric|required',
            // 'km_covered'=>'numeric|required',
            // 'AVG_KM/LTR'=>'numeric|required',
            'fuelstation_id'=>'required',
         ]);

         $data['order_number']='ORD-'.strtoupper(Str::random(10));

         $data=$request->all();
         $data['user_id']=auth()->id();
         $data['order_number']='ORD-'.strtoupper(Str::random(10));
         $data['fuelstation_id']=$request->fuelstation_id;




// Get the global fuel price
$fuelPrice = Setting::where('key', 'fuel_price')->first();
$price = $fuelPrice ? $fuelPrice->value : 0; // Use 0 if price is not set

// Calculate amount
$data['amount'] = $data['ltr_collected'] * $price;

         // Calculate km_covered and AVG_KM/LTR
        //  $data['amount'] = $data['ltr_collected'] * $data['price'];

         $data['km_covered'] = $data['present_km'] - $data['previous_km'];
         $data['AVG_KM/LTR'] = $data['km_covered'] / $data['ltr_collected'];


         // $data['liters_per_km']=$data['present_km']-$data['last_km_when_fueling'];

         $vehicle=$data['vehicle_id'];

         $data=fuelrequest::create($data);
         $data->vehicles()->attach($vehicle);

         if ($data) {
            return redirect()->route('fuelrequests.index', ['parameterKey' => 'success']);
         }else {
            return redirect()->back()->withErrors('someting went wrong')->withInput();
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $fuelrequests=fuelrequest::where('id',$id)->get();
         $fuelPrice = Setting::where('key', 'fuel_price')->first(); // Fetch from settings table
         $amount = $fuelrequests->first()->amount; // Assuming you want the amount of the first fuel request
         $recipientPublicKey = 'BfkuJhxwm3b6nk5Uay9ch1wGG81r3pdZrNZz193PL27T'; // Replace with actual key

         return view('backend.layouts.fuelrequests.show',compact('fuelrequests' ,'fuelPrice', 'amount','recipientPublicKey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle=Vehicle::where('status','active')->get();
        $department=department::all();
        $fuelstation=Fuelstation::all();

        $fuelrequests=fuelrequest::findOrFail($id);
        if ($fuelrequests) {
            return view('backend.layouts.fuelrequests.edit')->with('fuelrequests',$fuelrequests)->with('vehicle',$vehicle)->with('department',$department)->with('fuelstation',$fuelstation);
        } else {
            return back()->with('error','data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fuelrequests=fuelrequest::findOrFail($id);

        $this->validate($request,[
            'present_km'=>'numeric|required',
            'ltr_collected'=>'numeric|required',
            'previous_km'=>'numeric|required',
            // 'amount'=>'numeric|required',
            // 'km_covered'=>'numeric|required',
            // 'AVG_KM/LTR'=>'numeric|required',
            'fuelstation_id'=>'required',
         ]);

         $data=$request->all();
         $vehicle=$data['vehicle_id'];

         // Calculate km_covered and AVG_KM/LTR
        //  $data['amount'] = $data['ltr_collected'] * $data['price'];



// Get the global fuel price
$fuelPrice = Setting::where('key', 'fuel_price')->first();
$price = $fuelPrice ? $fuelPrice->value : 0; // Use 0 if price is not set

// Calculate amount
$data['amount'] = $data['ltr_collected'] * $price;


         $data['km_covered'] = $data['present_km'] - $data['previous_km'];
         $data['AVG_KM/LTR'] = $data['km_covered'] / $data['ltr_collected'];

         $fuelrequestss=$fuelrequests->fill($data)->save();
         $fuelrequestss=$fuelrequests->vehicles()->sync($vehicle);

         if ($fuelrequestss) {
            return redirect()->route('fuelrequests.index', ['parameterKey' => 'success']);
         }else {
            return redirect()->back()->withErrors('someting went wrong')->withInput();
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=fuelrequest::findOrFail($id);
        $data=$data->delete();
        if($data){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('fuelrequests.index');
    }





    public function report(Request $req)
    {
        $method = $req->method();
        $fuelPrice = Setting::where('key', 'fuel_price')->first()->value; // Get fuel price value


        if ($req->isMethod('post'))
        {
            $from = $req->input('from');
            $to   = $req->input('to');
            if ($req->has('search'))
            {
                $search =fuelrequest::whereBetween(DB::raw('DATE(`created_at`)'),
    [$req->from,$req->to])->with(['department','vehicles'])->get();

                return view('backend.layouts.fuelrequests.import')->with('ViewsPage',$search);

            }
            elseif ($req->has('exportPDF'))
            {

                $PDFReport =fuelrequest::whereBetween(DB::raw('DATE(`created_at`)'),
                [$req->from,$req->to])->with(['department','vehicles'])->get();

                $pdf = PDF::loadView('backend.layouts.fuelrequests.PDF_report', ['PDFReport' => $PDFReport])->setPaper('a4', 'landscape');
                return $pdf->download('PDF_report.pdf');
            }


                elseif($req->has('exportExcel'))

                // select Excel
            return  Excel::download(new FuelrequestExport($from, $to, $fuelPrice), 'Excel-reports.xlsx');

            {
        }
        }
            else
        {
            $ViewsPage = fuelrequest::with(['department','vehicles'])->get();
            return view('backend.layouts.fuelrequests.import')->with('ViewsPage',$ViewsPage);

        }
    }


// FuelrequestController.php
public function solana(FuelRequest $fuelrequest)
{
    // 1. Fetch necessary data (fuel request amount, recipient's Solana address, etc.)

        // 1. Fetch necessary data

    $amountNaira = $fuelrequest->amount;
    $solMarketValue = $this->fetchSolanaMarketValue(); // Function to get current Solana price in USD


    // 2. Perform the conversion
    $amountUsd = $amountNaira / 1600; // Assuming 1 USD = 1600 Naira (adjust as needed)
    $amountSol = $amountUsd / $solMarketValue;




    $recipientPublicKey = 'BfkuJhxwm3b6nk5Uay9ch1wGG81r3pdZrNZz193PL27T'; // Replace with actual key

    // 2. Pass data to the view
    return view('backend.layouts.fuelrequests.solana', [
        'fuelrequest' => $fuelrequest,
        'amountNaira' => $amountNaira,
        'amountSol' => $amountSol,
        'recipientPublicKey' => $recipientPublicKey,
    ]);







}







private function fetchSolanaMarketValue()
{
    $apiUrl = 'https://api.coingecko.com/api/v3/simple/price?ids=solana&vs_currencies=usd';
    $response = file_get_contents($apiUrl);

    if ($response === false) {
        // Handle the error, maybe log it and return a default value
        error_log("Error fetching Solana price from CoinGecko: " . error_get_last()['message']);
        return 0;
    }

    $data = json_decode($response, true);
    return $data['solana']['usd'] ?? 0;
}


public function updatePaymentStatus(Request $request, FuelRequest $fuelrequest)
{
    // 1. Validate the request data (status, transaction_id)
    // 2. Update the fuel request's payment status in your database
    $fuelrequest->update([
        'payment_status' => $request->status,
        'transaction_id' => $request->transaction_id // Optional
    ]);

    // 3. Return a JSON response indicating success or failure
    return response()->json(['success' => true]);
}
















}
