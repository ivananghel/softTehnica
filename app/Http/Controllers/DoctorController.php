<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Doctor;
use Datatables;
use Auth;

class DoctorController extends Controller
{
      /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return view('doctors.index', [
            'active_menu' => 'doctors',
        ]);
    }

    public function datatable() {
      
        $query = Doctor::all();

        return Datatables::of($query)
            ->addColumn('action', function(Doctor $doctor){
                return view('doctors.chunk.action', [
                    'id'        => $doctor->id,
                    'resource'  => 'doctors',
                ]);
            })
          
            ->editColumn('created_at', function(Doctor $doctor){
                return $doctor->created_at->format(config('project.formatUI'));
            })
          
            ->make(true);
    }

    public function create(){
       
        return view('doctors.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		$input = $request->all();
		$rules = config('validations.web.doctor.create');
		$this->validate($request, $rules);

		Doctor::create($input);
		
        return response()->view('message.success', array('message' => trans('Doctor has been successfully created') ));
    }

     public function edit($id) {
        $doctor = Doctor::findOrFail($id);
		return view('doctors.update', [
            'doctor'          => $doctor,

        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      	 
      	$input = $request->all();
        $rules = config('validations.web.doctor.update');
        $this->validate($request, $rules);

        $medic = Doctor::findOrFail($id);
        $medic->fill($input)->save();

        return response()->view('message.success', ['message' => trans('Doctor has been updated successfully')]);
    }

     public function destroy($id) {
        $currentUser = Auth::user();

        if ( $currentUser->hasRole('admin') ) {
          

            Doctor::destroy($id);

            return trans('Doctor has been successfully deleted');
        }

        return response( trans('Not enough permissions'), 406 );
    }


}
