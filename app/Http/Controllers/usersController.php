<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\users;
use Illuminate\Support\Facades\Storage;
use App\Models\Posts;


class usersController extends Controller
{

    public static function allUsers()
    {
        return users::where('type', null)->get();
    }

    public static function deleteUser(Request $request, $id)
    {
        $usr = users::findOrFail($id);
        $usr->delete();
        return redirect('/admin/users')->with('success', 'deleted successfully');
    }
    public static function deleteAdmin(Request $request, $id)
    {
        $usr = users::findOrFail($id);
        $usr->delete();
        return redirect('/admin/admins')->with('success', 'deleted successfully');
    }
    public static function allAdmins()
    {
        return users::where('type', 1)->get();
    }

    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication was successful
            $user = Auth::user(); // Retrieve authenticated user

            // Example logic to redirect based on user type
            if ($user->type == 1) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/home');
            }
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Retrieve input data
        $input = $request->only('Fname', 'Lname', 'username', 'gsm', 'email', 'password');

        // Check if username already exists
        $existingUsername = users::where('username', $input['username'])->exists();
        if ($existingUsername) {
            return redirect('/register')->withErrors(['username' => 'The username has already been taken.'])->withInput();
        }

        // Check if email already exists
        $existingEmail = users::where('email', $input['email'])->exists();
        if ($existingEmail) {
            return redirect('/register')->withErrors(['email' => 'The email has already been taken.'])->withInput();
        }

        // Create the user in the database
        $user = users::create([
            'Fname' => $input['Fname'],
            'Lname' => $input['Lname'],
            'username' => $input['username'],
            'gsm' => $input['gsm'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // Log in the user after creation
        Auth::login($user);

        // Redirect the user to the intended page (e.g., dashboard)
        return redirect()->intended('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function home()
    {
        // Fetch all posts with their associated user information
        $posts = Posts::with('author')->get();

        // Pass data to view
        return view('user.home', ['posts' => $posts]);
    }

    public function explore()
    {
        // Fetch all posts with their associated user information
        $posts = Posts::with('author')->get();

        // Pass data to view
        return view('user.explore', compact('posts'));
    }


    public function edit()
    {
        $user = Auth::user();
        return view('user.editUser', ['data' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'gsm' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old profile picture if exists
            if ($user->image && Storage::exists('public/users/' . $user->image)) {
                Storage::delete('public/users/' . $user->image);
            }
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/users', $fileName);
            $user->image = $fileName;
        }

        $user->Fname = $request->Fname;
        $user->Lname = $request->Lname;
        $user->username = $request->username;
        $user->gsm = $request->gsm;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('edit')->with('success', 'Profile updated successfully!');
    }
    public function posts()
    {
        return $this->hasMany(Posts::class);
    }
    public function addAdmin(Request $request)
    {
        // Check if username already exists
        $existingUsername = users::where('username', $request->input('username'))->exists();
        if ($existingUsername) {
            return redirect('/admin/adminAdd')->withErrors(['username' => 'The username has already been taken.'])->withInput();
        }

        // Check if email already exists
        $existingEmail = users::where('email', $request->input('email'))->exists();
        if ($existingEmail) {
            return redirect('/admin/adminAdd')->withErrors(['email' => 'The email has already been taken.'])->withInput();
        }

        // Create the user in the database
        $user = users::create([
            'Fname' => $request->input('Fname'),
            'Lname' => $request->input('Lname'),
            'username' => $request->input('username'),
            'gsm' => $request->input('gsm'),
            'type' => 1,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect the user to the intended page (e.g., dashboard)
        return redirect()->intended('/admin/adminAdd')->with('success', 'Admin added successfully');
    }
    public function userPage()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch all posts created by the authenticated user with their associated user information
        $posts = Posts::with('author')->where('user_id', $userId)->get();

        // Pass data to view
        return view('user.userPage', compact('posts'));
    }
}
