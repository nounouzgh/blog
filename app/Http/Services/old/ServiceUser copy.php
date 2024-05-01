<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Expert;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class ServiceUser
{
    protected $UserRepository;

    public function __construct(UserRepository $userModel)
{
    $this->UserRepository = $userModel;
}
public function getRole($userId)
{
    return $this->UserRepository->getRole($userId);
}
public function getRolecompte($adminId)
{
    return $this->UserRepository->getRolecompte($adminId);
}
public function getAllUsers()
{
    return $this->UserRepository->getAllUsers();
}


public function registerUser($userData)
    {
        // Validate the incoming user data
        $validatedData = validator($userData, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:student,teacher', // assuming roles can be 'student' or 'teacher'
            // Add more fields as needed
        ])->validate();

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($userData['password']), // Assuming you have a 'password' field in $userData
            // Add more user fields as needed
        ]);

        // Assign role based on the provided role
        if ($validatedData['role'] === 'student') {
            $student = new Student([
                'specialite' => $userData['specialite'], // Assuming you have a 'specialite' field in $userData
                'date_naissance' => $userData['date_naissance'], // Assuming you have a 'date_naissance' field in $userData
                'niveau' => $userData['niveau'], // Assuming you have a 'niveau' field in $userData
            ]);
            // Save the student record
            $user->student()->save($student);
        } elseif ($validatedData['role'] === 'teacher') {
            $teacher = new Teacher([
                'specialite' => $userData['specialite'], // Assuming you have a 'specialite' field in $userData
                'grade' => $userData['grade'], // Assuming you have a 'grade' field in $userData
            ]);
            // Save the teacher record
            $user->teacher()->save($teacher);
        }
        // Optionally, you can return the created user instance
        return $user;
    }

    public function deleteUser($userId)
    {
        // Find the user
        $user = User::findOrFail($userId);

        // Delete the user's associated student or teacher record if exists
        if ($user->role === 'student' && $user->student) {
            $user->student()->delete();
        } elseif ($user->role === 'teacher' && $user->teacher) {
            $user->teacher()->delete();
        }

        // Delete the user
        $user->delete();
    }

    public function updateUser($userId, $userData)
    {
        // Find the user
        $user = User::findOrFail($userId);

        // Validate the incoming user data
        $validatedData = validator($userData, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:student,teacher', // assuming roles can be 'student' or 'teacher'
            // Add more fields as needed
        ])->validate();

        // Update the user's name and email
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            // Add more user fields as needed
        ]);

        // Handle role-specific updates
        if ($validatedData['role'] === 'student') {
            if ($user->student) {
                $user->student()->update([
                    'specialite' => $userData['specialite'], // Assuming you have a 'specialite' field in $userData
                    'date_naissance' => $userData['date_naissance'], // Assuming you have a 'date_naissance' field in $userData
                    'niveau' => $userData['niveau'], // Assuming you have a 'niveau' field in $userData
                ]);
            } else {
                $student = new Student([
                    'specialite' => $userData['specialite'],
                    'date_naissance' => $userData['date_naissance'],
                    'niveau' => $userData['niveau'],
                ]);
                $user->student()->save($student);
            }
        } elseif ($validatedData['role'] === 'teacher') {
            if ($user->teacher) {
                $user->teacher()->update([
                    'specialite' => $userData['specialite'], // Assuming you have a 'specialite' field in $userData
                    'grade' => $userData['grade'], // Assuming you have a 'grade' field in $userData
                ]);
            } else {
                $teacher = new Teacher([
                    'specialite' => $userData['specialite'],
                    'grade' => $userData['grade'],
                ]);
                $user->teacher()->save($teacher);
            }
        }
        elseif ($validatedData['role'] === 'expert') {
            if ($user->expert) {
                $user->expert()->update([
                    'specialite' => $userData['specialite'], // Assuming you have a 'specialite' field in $userData
               ]);
            } else {
                $expert = new expert([
                    'specialite' => $userData['specialite'],
                ]);
                $user->expert()->save($expert);
            }
        }

        // Optionally, you can return the updated user instance
        return $user;
    }


    public function redirectBasedOnRole($userRole, $next, $request)
    {
        if ($userRole == "teacher") {
            return $next($request);
        } elseif ($userRole == "expert") {
            return redirect()->route('expert.dashboard');
        } elseif ($userRole == "student") {
            return redirect()->route('student.dashboard');
        } else {
            // Return a default response if no redirect is performed
            abort(403, 'Unauthorized action.');
        }
    }
}

