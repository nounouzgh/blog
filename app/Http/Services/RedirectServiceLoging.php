<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class RedirectServiceLoging
{
    public function redirectLogingBasedOnRole($userRole, $data)
    {
        switch ($userRole) {
            case "student":
                return $this->redirectStudentDashboard($data);
            case "teacher":
                return $this->redirectTeacherDashboard($data);
            case "expert":
                return $this->redirectexpertDashboard($data);
            case "admin":
                    return $this->redirectadminDashboard($data);
            default:
                return $this->redirectHome();
        }
    }

    public function redirectStudentDashboard($data)
    {
        return Redirect::route('student.dashboard', compact('data'));
    }

    public function redirectTeacherDashboard($data)
    {
        // Perform any necessary logic for the teacher dashboard
        // For example, you might want to perform additional checks or actions here
        return redirect()->route('teacher.dashboard', compact('data'));
    }

    public function redirectexpertDashboard($data)
    {
        // Perform any necessary logic for the expert dashboard
        // For example, you might want to perform additional checks or actions here
        return redirect()->route('expert.dashboard', compact('data'));
    }

    public function redirectGuestDashboard($data)
    {
        // Perform any necessary logic for the guest dashboard
        // For example, you might want to perform additional checks or actions here
        return redirect()->route('guest.dashboard', compact('data'));
    }
    public function redirectadminDashboard($data)
    {
        return redirect()->route('admin.dashboard', compact('data'));
    }

    public function redirectUnauthorized()
    {
        // Perform any necessary logic for the unauthorized redirect
        abort(403, 'Unauthorized');
    }

    public function redirectHome()
    {
        // Redirect to the home page
        return redirect()->route('welcome');
    }
}
