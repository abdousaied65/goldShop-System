<?php
namespace App\Http\Controllers\Supervisor\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;
    protected $redirectTo = RouteServiceProvider::SUPERVISOR_HOME;
    public function __construct()
    {
        $this->middleware('auth:supervisor-web');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function show(Request $request)
    {
        return $request->user('supervisor-web')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('supervisor.auth.verify');
    }
}
