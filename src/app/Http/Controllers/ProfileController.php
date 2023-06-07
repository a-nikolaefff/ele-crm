<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Create a new ProfileController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the user profile page.
     *
     * @return View The profile view.
     */
    public function index(): View
    {
        return view('profile');
    }
}
