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
            case "supervisor":
                return $this->redirectSupervisorDashboard($data);
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

    public function redirectSupervisorDashboard($data)
    {
        // Perform any necessary logic for the supervisor dashboard
        // For example, you might want to perform additional checks or actions here
        return redirect()->route('supervisor.dashboard', compact('data'));
    }

    public function redirectGuestDashboard($data)
    {
        // Perform any necessary logic for the guest dashboard
        // For example, you might want to perform additional checks or actions here
        return redirect()->route('guest.dashboard', compact('data'));
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
