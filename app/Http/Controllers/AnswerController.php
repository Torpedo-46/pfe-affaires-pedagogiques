<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use App\Models\Answer;
use App\Models\Group;
use App\Models\AnswerAttachment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AnswerController extends Controller

{

    public function index($id) {

        $group = Group::findOrFail($id);
        $answers = $group->answers()->paginate();

        return view('response.index', compact('group', 'answers'));

    }
    

    public function store(Request $request, $id) {

        $group = Group::findOrFail($id);

        if ($group->close_on && Carbon::now()->gt($group->close_on)) {
            return back()->with(['closed' => 'Désolé, la session d\'examen est fermé']);
        }

        $request->validate([
            'attachments'   => 'required',
            'attachments.*' => [ File::types(['docx', 'doc', 'pdf', 'jpeg', 'jpg', 'png'])->max(2 * 1024) ]
            //'attachments.*' :chaque fichier dont le nom commence par "attachments."
        ], [
            'attachments.required' => 'Veuillez ajouter les fichier de votre travail'
        ]);

        $answer = new Answer();
        $answer->user_id = auth()->id();
        $answer->group_id = $group->id;
        $answer->save();

        foreach ($request->attachments as $upload) {

            $file = FileController::store($upload); // Store the file on database
            $attachment = new AnswerAttachment();
            $attachment->file_id = $file;
            $attachment->answer_id = $answer->id;
            $attachment->save();
        
            $upload->store('answers/' . $answer->id);//La méthode store est fournie par la classe Illuminate\Http\UploadedFile de Laravel et permet de stocker un fichier uploadé à un emplacement donné. Le paramètre de la méthode est le chemin vers l'emplacement de stockage

        }

        return back()->with('success', 'Votre réponse a été rendu avec succès');
//with() permet de stocker un message dans la session
    }


    /**
     * 
     * 
     */
    public function delete($id) {

        $answer = Answer::where([ 'user_id' => auth()->id(), 'group_id' => $id ])->firstOrFail();
        $answer->files()->delete(); //pour supprimer les enregistrements liés à la réponse $answer dans la table files
        Storage::deleteDirectory('answers/' . $answer->id);
        $answer->delete();//Pour supprimer l'enregistrement dans la table answers
        return back()->with('success', 'Votre réponse d\'examen est annulé');
        
    }

    public function download($id, $answer) {

        $ans = Answer::find($answer);

        $zip = new \ZipArchive(); //En créant une nouvelle instance de la classe ZipArchive,on peut utiliser ses méthodes pour créer et manipuler des fichiers ZIP
        $zip->open("reponce.zip", \ZipArchive::CREATE | \ZipArchive::OVERWRITE);//cette methode crée un nouveau fichier ZIP et ouvre l'archive pour permettre l'ajout de fichiers à l'intérieur
                                                                                //Les constantes ZipArchive::CREATE et ZipArchive::OVERWRITE sont passées en paramètres à la méthode open() pour spécifier le mode d'ouverture. 
         
//Storage::path() pour récupérer le chemin absolu vers le fichier à ajouter 
// le 2eme arg est le nom du fichier dans l'archive ZIP                                                                      //CREATE permet de créer le fichier s'il n'existe pas, et OVERWRITE permet d'écraser le fichier s'il existe déjà
        foreach($ans->files as $file){
            $zip->addFile(Storage::path("answers\\$answer\\" . $file->storage_name), $file->file_name);
        }
// '\\' est utilisée pour échapper la première barre oblique. 
// pour éviter que la barre oblique soit interprétée comme un caractère spécial par PHP et par le système de fichiers        
     $zip->close();//Elle permet de finaliser l'archive et de la rendre utilisable en tant que fichier compressé


        return response()->download("reponce.zip");
// La méthode response()->download() crée une réponse HTTP qui va permettre de télécharger un fichier
//elle permet de renvoyer le fichier zip qui a été créé et ajouté dans le système de fichiers local vers le client en le téléchargeant

    }

}
