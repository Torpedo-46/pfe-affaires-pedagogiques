<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use App\Models\Group;
use App\Models\UserAttachment;
use App\Models\GroupAttachment;
use App\Models\Module;
use App\Models\GroupMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{

    /**
     * 
     */
    public function index($id_mod=null,Request $request) {
        if($request->category=='membre'){
            $members = GroupMember::where('module_id',$id_mod)->paginate(20);
        }
        else{
        $groups = Group::where('id_mod', $id_mod)->latest();
        
         $now = Carbon::now()->addHour()->toDateTimeString();
        switch($request->category):
            case 'sheduled': $groups = $groups->where('start_at', '>=', $now); break;
            default: $groups = $groups->where('start_at', '<=', $now); break;
        endswitch; 

        $groups = $groups->get();
    }
                  $mod=Module::where('id',$id_mod)->first();            
    if($request->category=='membre') return view('member.index', compact('members','mod'));

            return view('group.index', compact('groups','mod'));
    


    }

    /**
     * 
     * 
     */
    public function show($id) {
        $group = Group::findOrFail($id);
       return view('group.about', compact('group'));
    }


    /**
     * 
     * 
     */
    public function create() {
        $module = Module::select('id','name')->where('id_prof', auth()->user()->id)->get();
                return view('group.create',compact('module'));
    }
    
   
    public function store(Request $request) {


        $validator = Validator::make($request->all(), [
            'title'         => 'required|min:3',
            'publish'       => 'nullable',
            'module'         => 'required|not_in:0',
            'attachments.*' => [ 'nullable', File::types(['docx', 'doc', 'pdf', 'jpeg', 'jpg', 'png'])->max(2 * 1024) ]
        ], [
            'title.required' => 'Le titre du cours est obligatoire',
            'title.min' => 'Le titre doit être composé au mois par 3 caractères',
            
            'shedule_date.required' => 'La date de publication est obligatoire',
            'shedule_date.date_format' => 'La format de la date de publication est invalide',
            'shedule_time.required' => 'Le temps de publication est obligatoire',
            'shedule_time.date_format' => 'La format du temps de publication est invalide',
            'module.required'=>'L\'ajout du module est obligatoire',
            'module.not_in'=>'Le module selectinné est invalid',

  ]);

       
        $validator->sometimes('shedule_date', 'required|date_format:Y-m-d', fn() => $request->publish);
        $validator->sometimes('shedule_time', 'required|date_format:H:i', fn() => $request->publish);
     
        $validator->validate();
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
       $publish = $request->publish ? Carbon::createFromTimeString($request->shedule_date . ' ' . $request->shedule_time) : null;

        if ($request->publish && $publish->lt(now()->addHour())) {
            return back()->withInput()->withErrors(['publish_date' => 'La date de publication doit superieure a la date actuelle']);
        }

       

        $group = new Group();
        $group->title = $request->title;
        $group->user_id = auth()->user()->id;
        $group->id_mod=$request->module;
        $group->start_at = $request->publish ? $publish->toDateTimeString() : null;
        $group->save();

        // Save group attachments
        if($request->attachments) {
            foreach($request->attachments as $upload) {
                
                $fid = FileController::store($upload); // Store the file
                
                $attachment = new GroupAttachment;
                $attachment->group_id = $group->id;
                $attachment->file_id = $fid;
                $attachment->save();

                // Store the file intro global directory groups
                $upload->store('groups/' . $group->id);

            }
        }
        return redirect()->route('group.index',['id' => $request->module])->with('success', "Le cours du module a été partagé avec success");

    }


    /**
     * De
     * 
     * @return \Illuminate\Http\Request
     */
    public function delete($id) {

        $group = Group::findOrFail($id);
        $group->files()->delete(); // Delete all files records on database
        Storage::deleteDirectory('groups/' . $group->id); // Delete group files on storage
        $group->delete(); // Delete the group
        return redirect()->route('group.index',['id' => $group->id_mod])->with('success', 'L\'cours a été supprimer avec succès');

    }

    /**
     * Edit an group assignment
     */
    public function edit($id) {
        $group = Group::findOrFail($id);
        return view('group.edit', compact('group'));
    }

    /**
     * 
     */
    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'title'         => 'required|min:3',
            'module' => 'required|exists:modules,name'
           
        ]);

        $validator->validate();
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

       $publish = $request->publish ? Carbon::createFromTimeString($request->shedule_date . ' ' . $request->shedule_time) : null;
       if ($request->publish && $publish->lt(now()->addHour())) {
        return back()->withInput()->withErrors(['publish_date' => 'La date de publication doit superieure a la date actuelle']);
    }
    $mod=Module::where('name',$request->module)->first();

    $group = Group::find($id);
    $group->title = $request->title;
    $group->user_id = auth()->id();
    $group->id_mod=$mod->id;
    $group->start_at = $request->publish ? $publish->toDateTimeString() : null;
    $group->save();

        // Save group attachments
        if ($request->attachments) {
            foreach($request->attachments as $upload) {
                    
                $attachment = new GroupAttachment;
                $attachment->group_id = $group->id;
                $attachment->file_id = FileController::store($upload);
                $attachment->save();
    
                // Store the file intro global directory groups
                $upload->store('groups/' . $group->id);
    
            }
        }
        
        return redirect()->route('group.index',['id' => $mod->id])->with('success', 'Le cours a été bien modifier');
        

    }


}
