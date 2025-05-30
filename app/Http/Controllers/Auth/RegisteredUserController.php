<?php


namespace App\Http\Controllers\Auth;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $companies = Company::all();
        return view('auth.register', compact('companies'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'company_id' => 'required|exists:companies,id',
        'role' => 'required|in:admin,staff', // <-- ✨ Add this line
    ]);

    // If the role is superadmin, company_id should be null
    $companyId = $request->role === 'superadmin' ? null : $request->company_id;

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'company_id' => $companyId, // Dynamically set company_id
        'role' => $request->role,
        'is_approved' => false,
    ]);

    event(new Registered($user));

    // Auth::login($user);

    // logout immediately
    Auth::logout();

    // redirect with message that will show on login page
    return redirect()->route('login')->with('status', 'Your account has been successfully registered. Please wait for approval. You will receive an email once approved.');
}

}
