<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\fuelrequest;
use App\Models\department;
// use DB;
// use PDF;
use PDF;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;




use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with(['roles','department'])->get();
        // $user->role->name
            // $fuelrequest = fuelrequest::with(['vehicles','user'])->get();
          //  $users= User::with(['department'])->get();



         //$users = User::where(['id'=>auth()->user()->id])->with('roles')->get();


         // $users = User::with(['fuelrequests','department'])->get();


          //$users->hasRole('HOD');


            //dd($users);
       // $users= User::orderBy('id','ASC')->paginate(10);


        return view('backend.layouts.users.index')->with('users',$users);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','name')->all();
        $department=department::all();


        return view('backend.layouts.users.create',compact('roles','department'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required|unique:users',
            'password'=>'string|required|min:4',
            'roles' => 'required',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
            'sap'=>'numeric|nullable|unique:users|min:4',
            'phone'=>'numeric|nullable|unique:users|min:11',
            'department_id'=>'required',




        ]);







        $data=$request->all();
        $data['password']=Hash::make($request->password);
        // dd($data);
        $status=User::create($data);
        $status->assignRole($request->input('roles'));
        

        // dd($status);
        if($status){
            request()->session()->flash('success','Successfully added user');
        }
        else{
            request()->session()->flash('error','Error occurred while adding user');
        }
        return redirect()->route('users.index');









        // dd($request->all());
        // $data=$request->all();

        // // $data['department_id']=$request->department_id;

        // $data['password']=Hash::make($request->password);
        // // dd($data);
        // $status=User::create($data);

        // $status->assignRole($request->input('roles'));

        // // dd($status);
        // if($status){
        //     request()->session()->flash('success','Successfully added user');
        // }
        // else{
        //     request()->session()->flash('error','Error occurred while adding user');
        // }
        // return redirect()->route('users.index');
    }



    public function userStatus(Request $request)
    {

        //dd($request->all());

        if ($request->mode == 'true') {
            DB::table('users')->where('id', $request->id)->update(['status'=>'active']);
            # code...
        }
        else {
            DB::table('users')->where('id', $request->id)->update(['status'=>'inactive']);

            # code...
        }

        return response()->json(['msg'=>'Successfully updated status','status'=>true]);


    }




















    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);
        $roles = Role::get();

        $department=department::findOrFail($id);
       // dd($department);
        return view('backend.layouts.users.edit')->with('user',$user)->with('roles',$roles)->with('department',$department);
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
        $user=User::findOrFail($id);
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required|exists:users,email',
           // 'password'=>'string|required|min:4',
            'roles' => 'required',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
            'sap'=>'numeric|nullable|min:4',
            'phone'=>'numeric|nullable|min:11',
           'department_id'=>'required',



        ]);







        $data=$request->all();

        $user->update($data);
      //  DB::table('model_has_roles')->where('model_id',$id)->delete();

        DB::table('role_user')->where('role_id',$id)->delete();

    
        $user->syncRoles($request->input('roles'));
       // $data=$request->all();

        // dd($data);

        // $status=$user->fill($data)->save();
        
        // if($status){
        //     request()->session()->flash('success','Successfully updated');
        // }
        // else{
        //     request()->session()->flash('error','Error occured while updating');
        // }
        return redirect()->route('users.index');

        // dd($request->all());
       // $input=$request->all();
        // dd($data);

        // if(!empty($input['password'])){
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));
        // }

       // $user = User::find($id);
        // $input['department_id']=$request->department_id;


        //$user->update($input);
       // DB::table('model_has_roles')->where('model_id',$id)->delete();

       // $user->assignRole($request->input('roles'));

       // return redirect()->route('users.index')
           //             ->with('success','User updated successfully');

        // $status=$user->fill($data)->save();
        // if($status){
        //     request()->session()->flash('success','Successfully updated');
        // }
        // else{
        //     request()->session()->flash('error','Error occured while updating');
        // }
        // return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete=User::findorFail($id);
        $status=$delete->delete();
        if($status){
            request()->session()->flash('success','User Successfully deleted');
        }
        else{
            request()->session()->flash('error','There is an error while deleting users');
        }
        return redirect()->route('users.index');
    }





    public function report(Request $req)
    {
        $method = $req->method();

        if ($req->isMethod('post'))
        {
            $from = $req->input('from');
            $to   = $req->input('to');
            if ($req->has('search'))
            {
                // select search
                $search = User::whereDate('created_at', [$from, $to])->with(['department'])->get();

                $department = department::all();//whereDate('created_at', [$from, $to])->with(['department'])->get();


                //  DB::table('users')->where('created_at',array($from, $to))->get();
                //select("SELECT * FROM users WHERE created_at BETWEEN '$from' AND '$to'");
                // return view('import',['ViewsPage' => $search]);
                // $users = User::with(['department'])->get();


                // DB::table('users')
                // ->whereBetween('created_at', array($from, $to))
                // ->get();


                // dd($search);

                return view('backend.layouts.users.import')->with('ViewsPage',$search)->with('department',$department);//->with('roles',$roles)->with('department',$department);

            }
            elseif ($req->has('exportPDF'))
            {
                // select PDF
                $PDFReport =  User::whereDate('created_at', [$from, $to])->with(['department'])->get();
                // User::select('*')->where('created_at','>=',$this->from)->where('created_at','<=', $this->to)->with(['department'])->get();// DB::select("SELECT * FROM users WHERE created_at BETWEEN '$from' AND '$to'");
                $pdf = PDF::loadView('backend.layouts.users.PDF_report', ['PDFReport' => $PDFReport])->setPaper('a4', 'landscape');
                return $pdf->download('PDF_report.pdf');
            }


                elseif($req->has('exportExcel'))

                // select Excel
                return Excel::download(new UsersExport($from, $to), 'Excel-reports.xlsx');
            {
        }
        }
            else
        {
            //select all
            $ViewsPage = User::with(['department'])->get();
            // dd($ViewsPage);
            // return view('import',['ViewsPage' => $ViewsPage]);

            return view('backend.layouts.users.import')->with('ViewsPage',$ViewsPage);//->with('roles',$roles)->with('department',$department);

        }
    }
























}
