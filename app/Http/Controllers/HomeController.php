<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Pustaka;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $latestBooks = Pustaka::with(['pengarang', 'penerbit'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        return view('User.home', compact('latestBooks'));
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        $dailyRegistrations = [];
        
        // Get registrations for last 7 days
        for($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $dailyRegistrations[] = $count;
        }

        return view('Admin.adminHome', compact('dailyRegistrations'));
    }

    public function showBook($id): View
    {
        $book = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
            ->findOrFail($id);
        
        return view('User.book-detail', compact('book'));
    }
}
