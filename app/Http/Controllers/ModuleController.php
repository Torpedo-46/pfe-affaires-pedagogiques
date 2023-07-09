<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Validator;


class ModuleController extends Controller
{
    
    public function index() {

        
        if(auth()->user()->role==1) 
        $modules = Module::where('id_prof', auth()->user()->id)->get();
        elseif(auth()->user()->role==2) 
         $modules=Module::all();
       else{
        $moduleIds = GroupMember::where('user_id', auth()->user()->id)->pluck('module_id');
        $modules = Module::whereIn('id', $moduleIds)->orderBy('name','asc')->get();
       }
     
       return view('module.show', compact('modules'));

    }


   
    public function add() {
        $profs=User::select('id','first_name', 'last_name')
        ->where('role', '=', '1')->get();
        return view('module.add',compact('profs'));
    }

    public function affecter() {
        $etds=User::select('id','apogee','first_name','last_name')
        ->where('role', '=', '0')
        ->get();
        $mods=Module::select('name','id')->get();
        return view('module.add',compact('etds','mods'));
    }

    /**
     * Ajouter l'utilisateur au cours à partir d'un code donné
     */
    public function store(Request $request) {
        if ($request->has('id_prof')){
        $validator = Validator::make($request->all(), [
            'id_prof' => 'required|exists:users,id' ,
            'name_mod' => 'required' 


          ], [
            'name_mod.required' => 'Le nom du module est obligatoire',
            'id_prof.exists' => 'Ce prof n\'existe pas',
            'id_prof.required' => 'le nom du prof est obligatoire'

        ]);

        $validator->validate();

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        if ( Module::where( 'name' , $request->name_mod )->exists()) {
            return back()->with('info', 'ce module existe deja');
        }
         
         $module = new Module;
         $module->name = $request->name_mod;
         $module->id_prof = $request->id_prof;
         $module->save();

        return back()->with('success', "Vous avez ajouté le module <b>" .  $request->name_mod . "</b>");
    }
    if ($request->has('note')){
        $validator = Validator::make($request->all(), [
            'id_etd' => 'required|array' ,
            'note' => 'required' 
    
    
          ], [
            'note.required' => 'La note du module est obligatoire',
    
        ]);
        $validator->validate();
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $etds = $request->input('id_etd');
        foreach($etds as $et){
            $m=GroupMember::where(['module_id' => $request->id_mod,'user_id'=> $et] )->first();
            $m->note=$request->note;
            $m->save();
            }

        return back()->with('success', "Vous avez ajouté la(les) note(s) avec success ");
    
    
         



    }
else{
    $validator = Validator::make($request->all(), [
        'id_etd' => 'required|array' ,
        'id_mod' => 'required' 


      ]);
    $validator->validate();

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }


     
    $etds = $request->input('id_etd');
    foreach($etds as $et){
        if (!GroupMember::where(['module_id' => $request->id_mod,'user_id'=> $et] )->exists()) { 
     $grMb=new GroupMember;
     $grMb->user_id = $et;
     $grMb->module_id = $request->id_mod;
     $grMb->save();
        }
    }
    return back()->with('success', "Vous avez ajouté le(s) etudiant(s) au module avec success ");


}

    }
    public function deleteMember($id, $member_id) {
        
        $member = GroupMember::where([ 'user_id' => $member_id,'module_id' => $id  ])->firstOrFail();
        $member->delete();
        return back()->with('success', 'L\'étudiant a été supprimé avec succés');


    }

    
    

}
