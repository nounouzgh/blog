<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Signal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignalController extends Controller
{
    public function show($id)
    {
        $userreport = User::findOrFail($id); // Fetch the user by ID
        $signals = Signal::where('user_id', $id)->latest()->paginate(4); // Fetch signals for the user and order them by the latest one first, paginated with 10 signals per page
        $allCauses = Signal::where('user_id', $id)->pluck('cause')->unique(); // Assuming you want to get unique causes across all signals, not just the paginated ones
    
        return view('user.Signal', compact('signals', 'allCauses', 'userreport'));
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
           
            'cause' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userreport = User::findOrFail($request->user_id); // Fetch the user by ID
        Signal::create([
            'compte_id' => $userreport->compte->id,
            'user_id' => $request->user_id,
            'signal_date' => now(),
            'cause' => $request->cause,
        ]);

        return redirect()->back()->with('success', 'Signal created successfully!');
    }
}
