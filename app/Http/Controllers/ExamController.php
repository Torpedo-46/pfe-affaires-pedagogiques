<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Module;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;



class ExamController extends Controller
{
    
    public function index(Module $module) {
        $id_mod=$module->id;
        $nom_mod=$module->name;
        if(request()->has('n')){
      /*   $memberIds=GroupMember::where('module_id',$id_mod)->pluck('user_id');
        $etds=User::whereIn('id',$memberIds)->select(['id','apogee'])->get(); */
        $etds=GroupMember::where('module_id',$id_mod)->select('user_id','note')->with('user')->get();
        return view('exams.note', compact('etds','id_mod','nom_mod'));
        }
         $id_prof=$module->id_prof;
         $nom_mod=$module->name;
         $nom_prof=User::where('id',$id_prof)->first()->full_name;
        $exam=Exam::where('id_mod',$id_mod)->first();
        if($exam){
        $fin=$exam->fin();
        if($exam && $exam->exists() && now()->addHour()->lt($fin)) return view('exams.show', compact('exam','nom_mod','nom_prof'));
        }
        $users=User::select('id','first_name','last_name')->where('role',1)->get();
        return view('exams.add', compact('id_mod','nom_mod','nom_prof','users'));

    }


   
    public function show($id=null) {
        if($id==null){
            if(auth()->user()->role==1)
        $mod=Module::where('id_prof',auth()->user()->id)->pluck('id');
        else
          $mod=GroupMember::where('user_id',auth()->user()->id)
          ->where(function ($query) {
            $query->where('note', '<', 10)
                ->where('note', '>', 5)
                ->orWhereNull('note');
        })
          ->pluck('module_id');
          $exam = Exam::whereIn('id_mod', $mod)->orderBy('deb','asc') ->get();
         $exam = $exam->filter(function ($item) {
         return now()->addHour()->lt($item->fin());
           });
             return view('exams.list', compact('exam'));      
    }
       else { $exam=Exam::where('id_mod',$id)->first();
        $nom_mod=$exam->names->name;
        $nom_prof=User::where('id',$exam->names->id_prof)->first()->full_name;

        return view('exams.show', compact('exam','nom_mod','nom_prof'));
       }
    }
    public function notes(){
        $mod=GroupMember::where('user_id',auth()->user()->id)->whereNotNull('note')->get();
        return view('exams.list', compact('mod'));

    }
    public function affecter() {
        $etds=User::select('id','apogee')
        ->where('role', '=', '0')
        ->get();
        $mods=Module::select('name','id')->get();
        return view('module.add',compact('etds','mods'));
    }

    /**
     * Ajouter l'utilisateur au cours à partir d'un code donné
     */
    public function store(Request $request) {
      
         $validator = Validator::make($request->all(), [
            'deb' => 'required',
            'duree' => 'required' ,
            's'=>'required',
         ],[
            's.required'=>'vous devez saisir le serveillant'
         ] );   
        
        $validator->validate();
 if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 
        $deb = Carbon::parse($request->input('deb'));

 
                 if ( $deb->lt(now()->addHour())) {
                    return back()->withInput()->withErrors(['deb_date' => 'La date d\'examen doit superieure a la date actuelle']);
                }
         $exam=Exam::where('id_mod',$request->id_mod)->first();
         if(!$exam) $exam = new Exam;
                $s='ordinaire';
          if($request->session==1) $s='rattrapage'; 
         $exam->id_mod = $request->id_mod;
         $exam->session = $s;
         $exam->surveillant=$request->s;
         $exam->deb = $deb;
         $exam->duree = $request->duree;
         $exam->save(); 

        return back()->with('success', "Vous avez plagnifié l'exam avec succes ");
    }
    public function delete($id_mod) {

        $exam = exam::where('id_mod',$id_mod);
        $exam->delete(); // Delete the group
        $module=Module::where('id',$id_mod)->first();
        return redirect()->route('exam.add',['module' => $module])->with('success', 'L\'exam a été supprimer avec succès');
    }  

    
    

    
    

}
