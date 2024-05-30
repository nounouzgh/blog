<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Reunion;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Invitation;
use App\Models\Particeperreunion;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;



class ReunionController extends Controller
{
    /**
     * Show the form for creating a new reunion.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('reunions.create');
    }

    /**
     * Store a newly created reunion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'date' => 'required|date',
            'duree' => 'required|integer',
            'specialite' => 'required|string|max:255',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Get the teacher related to the authenticated user
        $teacher = $user->teacher;

        // Create a new Reunion instance with validated data
        $reunion = new Reunion($validatedData);

        // Set the iduser_etd attribute to the teacher's id
        $reunion->iduser_etd = $teacher->id;

        // Save the new reunion to the database
        $reunion->save();

        // Return a response, for example, the newly created reunion or a success message
    //return response()->json(['message' => 'Reunion created successfully', 'reunion' => $reunion], 201);
   // Redirect back to the same page after processing the form

   return view('reunions.invite', compact('reunion'));
 //  return redirect()->back()->with('message', 'Reunion created successfully!');    
}



    public function reunionInviter($reunionId)
    {
         // Retrieve the reunion details
            $reunion = Reunion::findOrFail($reunionId);
 
         return view('reunions.invite', compact('reunion'));
        
        }

        public function getStudentList()
        {

            $student = Student::with('users')->paginate(5);
         
            return response()->json($student);
        }
    
        public function getTeacherList()
        {

            $teacher = Teacher::with('users')->paginate(5); // Eager load the associated users
            return response()->json($teacher);
        }

    public function invite($reunionId, Request $request)
{
    try {
        $selectedUserIds = $request->input('selected_user_ids'); // Use 'selected_user_ids' for array input
        
        // Debugging: Log the received data
        Log::info('Received data:', [
            'selected_user_ids' => $selectedUserIds,
            'invitation_date' => $request->input('invitation_date'),
        ]);
    
        // Ensure selectedUserIds are present
        if (empty($selectedUserIds)) {
            throw new \Exception('Selected user IDs are missing');
        }
    
        // Loop through each selected user
        foreach ($selectedUserIds as $selectedUserId) {
            // Check if an invitation already exists for the user and reunion
            $existingInvitation = Invitation::where('user_id', $selectedUserId)
                                            ->where('reunion_id', $reunionId)
                                            ->first();
            // If no existing invitation, create a new one
            if (!$existingInvitation) {
                $invitation = new Invitation();
                $invitation->user_id = $selectedUserId;
                $invitation->reunion_id = $reunionId;
                $invitation->invitation_date = $request->input('invitation_date');
                $invitation->save();
            }
        }
        
        return response()->json([
            'success' => true,
            'selected_user_ids' => $selectedUserIds,
            'invitation_date' => $request->input('invitation_date'),
            'message' => 'Invitations sent successfully to users'
        ]);
    } catch (\Exception $e) {
        Log::error('Error in invitation:', ['exception' => $e]);
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function listInviteReunionUser()
{
    $userId = Auth::id();
    $currentDate = now();

    // i do it 2 time bnecouse of pagination u need collection for u can use paginate and use parameter
    // Retrieve all invitations for the authenticated user, joining with reunions and ordering by the relevant dates
    $doneInvitationsPaginated = Invitation::where('user_id', $userId)
        ->join('reunions', 'invitations.reunion_id', '=', 'reunions.id')
        ->where('reunions.date', '<', $currentDate) // Filter by reunion date
        ->orderBy('invitations.invitation_date', 'desc')
        ->orderBy('reunions.date', 'desc')
        ->select('invitations.*')
        ->with('reunion')
        ->paginate(3, ['*'], 'done');;

      // Retrieve all invitations for the authenticated user, joining with reunions and ordering by the relevant dates
    $waitingInvitationsPaginated = Invitation::where('user_id', $userId)
    ->join('reunions', 'invitations.reunion_id', '=', 'reunions.id')
    ->where('reunions.date', '>=', $currentDate) // Filter by reunion date
    ->orderBy('invitations.invitation_date', 'desc')
    ->orderBy('reunions.date', 'desc')
    ->select('invitations.*')
    ->with('reunion')
    ->paginate(3, ['*'], 'waiting');
 
    return view('reunions.ListInvitaion', [
        'doneInvitations' => $doneInvitationsPaginated,
        'waitingInvitations' => $waitingInvitationsPaginated,
    ]);
}


public function getNumberInviteReunion()
{
    $userId = Auth::id();
    $currentDate = now();

    $WaitingInvitationsCount = Invitation::where('user_id', $userId)
        ->join('reunions', 'invitations.reunion_id', '=', 'reunions.id')
        ->where('reunions.date', '>=', $currentDate) // Filter by reunion date
        ->count();
    return $WaitingInvitationsCount;
}
    

public function listReunion()
{
    $currentDate = now();
    $newreunions = Reunion::whereDate('date', '>=', $currentDate)
    ->orderBy('date', 'desc')
    ->paginate(3);


    $teacher = Auth::user()->teacher;
    //dd($teacher);
    return view('reunions.listReunion', [
        'newreunions' => $newreunions,
        'teacher' => $teacher,
    ]);
}


public function destroy($id)
{
    $reunion = Reunion::findOrFail($id);
    $reunion->delete();

    return redirect()->back()->with('success', 'Resource deleted successfully');
}




public function participate($idreunion)
{
    // Get the authenticated user's ID
    $userId = Auth::id();

    try {
        // Check if the participation already exists
        $existingParticipation = Particeperreunion::where('user_id', $userId)
                                                  ->where('reunion_id', $idreunion)
                                                  ->first();

        if (!$existingParticipation) {
            // Create a new Particeperreunion record
            Particeperreunion::create([
                'user_id' => $userId,
                'reunion_id' => $idreunion,
            ]);
        }

        // Check if the invitation already exists
        $existingInvitation = Invitation::where('user_id', $userId)
                                        ->where('reunion_id', $idreunion)
                                        ->first();

        if (!$existingInvitation) {
            // Create a new Invitation record
            Invitation::create([
                'user_id' => $userId,
                'reunion_id' => $idreunion,
                'invitation_date' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'User has been added to the reunion successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to add user to the reunion.');
    }
}

}


