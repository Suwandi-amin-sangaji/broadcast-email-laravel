<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total tiket secara keseluruhan
        $totalTickets = Ticket::count();

        // Mengambil jumlah tiket berdasarkan kategori (misalnya 5K, 10K, dll)
        $categories = ['5 K', '10 K', '21 K', '42 K'];  // Ganti dengan kategori Anda
        $ticketsByCategory = [];

        foreach ($categories as $category) {
            $ticketsByCategory[$category] = Ticket::where('category', $category)->count();
        }

        return view('dashboard', compact('totalTickets', 'ticketsByCategory'));
    }
}
