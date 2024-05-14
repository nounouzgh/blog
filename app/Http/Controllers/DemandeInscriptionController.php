<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeInscription;
use App\Models\User;

class DemandeInscriptionController extends Controller
{

    public function listDemandeInscription()
    {
        $DemandeInscription = DemandeInscription::latest()->paginate(4); // Retrieve users sorted by creation date in descending order and paginate with 4 users per page
    
        return view('inscription.demande_inscriptions', ['DemandeInscription' => $DemandeInscription]); // Pass the paginated users to the view
    }

    public function show($id)
    {
        $demandeInscription = DemandeInscription::findOrFail($id);

        return view('inscription.demande_inscriptions_show', compact('demandeInscription'));
      
    }

    public function active_destroy($id)
    {
        $demandeInscription = DemandeInscription::findOrFail($id);
       // $user=User::findOrFail($demandeInscription->expert->user_id);    
        $demandeInscription->expert->users->compte->update(['etat' => 1]);
        $demandeInscription->delete();
        return redirect()->route('demande-inscriptions.index')->with('success', 'Inscription request deleted successfully!');

    }
}
