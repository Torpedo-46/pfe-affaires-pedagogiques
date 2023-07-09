<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Group;

class MemberController extends Controller
{
    
    /**
     * 
     * 
     */
   /*  public function index($id) {
        $group = Group::findOrFail($id);
        $members = $group->members()->paginate(20);
        return view('member.index', compact('group', 'members'));
    } */


    /**
     * 
     * 
     */
    public function add() {
        return view('member.add');
    }

    /**
     * Ajouter l'utilisateur au cours à partir d'un code donné
     */
    public function store(Request $request) {
        
        $request->validate([
            'code' => 'required|exists:groups,code' 
     ], [
            'code.required' => 'Le code du cours est obligatoire',
            'code.exists' => 'Ce code du cours n\'existe pas'
        ]);

        $group = Group::where([ 'code' => $request->code ])->firstOrFail();

        if (GroupMember::where(['group_id' => $group->id, 'user_id' => auth()->id()])->exists()) {
            return back()->with('info', 'Vous êtres déja un membre de cette cours');
        }

        $member = new GroupMember;
        $member->group_id = $group->id;
        $member->user_id = auth()->id();
        $member->save();

        return redirect()->route('group.index')->with('success', "Vous êtes maintenant concerné du cours <b>" . $group->title . "</b>");

    }/*
    $request->validate([
        'code' => 'required|exists:users,email' //vérifie que la valeur de l'attribut de validation existe dans la table "groups" et plus précisément dans la colonne "code
    ], [
        'code.required' => 'Le code d\'cours est obligatoire',
        'code.exists' => 'Ce code d\'cours n\'existe pas'
    ]);

    $user = User::where([ 'email' => $request->code ])->firstOrFail();
   
    if (!$user->role) {
        return back()->with('info', 'code invalide');
    }

    if (UserAttachment::where(['prof_id' => $user->id, 'etd_id' => auth()->id()])->exists()) {
        return back()->with('info', 'Vous êtres déja un membre');
    }

    $member = new UserAttachment;
    $member->prof_id = $user->id;
    $member->etd_id = auth()->id();
    $member->save();

    return redirect()->route('group.index')->with('success', "Vous êtes maintenant concerné par les cours de  <b>Pr." . $user->first_name . "</b>");

*/

    /**
     * 
     * 
     */
    public function delete($id, $member_id) {
        
        $member = GroupMember::where([ 'group_id' => $id, 'user_id' => $member_id ])->firstOrFail();
        $member->delete();
        return back()->with('success', 'L\'étudiant a été supprimé avec succés');


    }
    

}
