<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
 
class UserController extends Controller
{
 
    public function showLogin() {
        return view('auth.login');
    }
 
    public function showRegister() {
        return view('auth.register');
    }

    public function showDashboard() {
        return view('auth.dashboard');
    }
 
    // public function showProfile() {
    //     return view('auth.profile');
    // }
 
    /**
     * Display a listing of the resource.
     */
    // Get All Users
    public function index()
    {
        try {
            return response()->json(User::all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching users' . $e->getMessage()], 500);
        }
    }
 
    /**
     * Register a newly created resource in storage.
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:4',
            ]);
   
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'bio' => $request->bio,
                'profile_picture' => $request->profile_picture
            ]);
 
            if ($request->wantsJson()) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'message' => 'User registered successfully',
                    'user' => $user,
                    'token' => $token
                ], 201);
            }
           
            auth()->login($user);
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
 
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Error creating user : '. $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage())->withInput();
        }
    }
 
    /**
     * Login a user.
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
 
        $credentials = $request->only('email', 'password');
       
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
           
            if ($request->wantsJson()) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'message' => 'User logged in successfully',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }
           
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }
       
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
       
        return redirect()->back()->with('error', 'Invalid credentials')->withInput();
    }
 
    /**
     * Logout the current logged in user
     */
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
 
    /**
     * Web logout method
     */
    public function webLogout() {
        auth()->logout();
        return redirect()->route('home')->with('success', 'Logged out successfully');
    }
 
    /**
     * Get current logged in user information
     */
    public function me(Request $request) {
        return response()->json($request->user());
    }
 
    /**
     * Display the specified resource.
     */
    // Get One User
    public function show(User $user)
    {
        return response()->json($user);
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
 
            $validatedData = $request->validate([
                'username' => 'string|max:255|unique:users,username,' . $user->id,
                'email' => 'email|unique:users,email,' . $user->id,
                'password' => 'string|min:4',
            ]);
 
            if($request->filled('password')) {
                $validatedData['password'] = bcrypt($request->password);
            }
            if (!empty($validatedData)) {
                $user->update($validatedData);
            }
            $user->refresh();
            return response()->json(['message' => 'User updated', 'user' => $user], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating user : '. $e->getMessage()], 500);
        }
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
   
            $user->delete();
            return response()->json(['message' => 'User deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user: ' . $e->getMessage()], 500);
        }
    }
 
    public function profile(Request $request) {
        $user = auth()->user();
        if(!$user) {
            return redirect()->route('login')->with('error', 'You are not logged in');
        }
        return view('auth.profile', compact('user'));
    }

    public function uploadImage(Request $request)
    {
        // Valider l'image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Vérifier si l'image est présente
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Créer un nom unique pour l'image
            $imageName = time() . '_' . $image->getClientOriginalName();
    
            // Sauvegarder l'image dans le dossier 'profile_pictures' dans le dossier 'public/storage'
            $imagePath = $image->storeAs('profile_pictures', $imageName, 'public');
    
            // Mettre à jour le profil de l'utilisateur avec le chemin relatif de l'image
            auth()->user()->update(['profile_picture' => $imagePath]);
    
            // Répondre avec succès
            return back()->with('success', 'Image uploaded successfully!');
        }
    
        return back()->with('error', 'No image uploaded');
    }

    public function updateBio(Request $request)
    {
        $validatedData = $request->validate([
            'bio' => 'nullable|string|max:500'
        ]);

        $user = auth()->user();
        $user->bio = $validatedData['bio'];
        $user->save();

        return redirect()->back()->with('success', 'Votre bio a été mise à jour avec succès');
    }

    
   
}
 