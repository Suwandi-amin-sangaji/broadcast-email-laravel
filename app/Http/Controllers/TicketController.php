<?php

namespace App\Http\Controllers;

use App\Imports\TicketsImport;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Mail\TicketEmail;



class TicketController extends Controller
{


    public function index()
    {
        $tickets = Ticket::paginate(50); // Ambil 10 data tiket per halaman
        return view('import-tickets', compact('tickets'));
    }

    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Proses import menggunakan library Excel
        Excel::import(new TicketsImport, $request->file('excel_file'));

        return redirect()->route('tickets.index')->with('success', 'Data tiket berhasil diimport.');
    }


    public function broadcastEmails()
    {
        $tickets = Ticket::all(); // Ambil semua data tiket

        if ($tickets->isEmpty()) {
            return redirect()->route('tickets.index')->with('error', 'Tidak ada data tiket untuk dikirim.');
        }

        foreach ($tickets as $ticket) {
            // Kirim email ke setiap peserta
            Mail::to($ticket->email)->send(new TicketEmail($ticket));
        }

        return redirect()->route('tickets.index')->with('success', 'Email berhasil dikirim ke semua peserta.');
    }


    public function deleteMultiple(Request $request)
    {
        // Validasi bahwa data 'ids' dikirimkan
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tickets,id',
        ]);

        // Hapus tiket berdasarkan ID
        Ticket::whereIn('id', $request->ids)->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('tickets.index')->with('success', 'Perserta berhasil dihapus.');
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id); // Ambil data tiket berdasarkan ID
        return view('tickets.edit', compact('ticket')); // Tampilkan view edit dengan data tiket
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'bib_number' => 'required',
            'name' => 'required',
            'category' => 'required',
            'jersey_size' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
        ]);

        // Update data tiket
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'bib_number' => $request->bib_number,
            'name' => $request->name,
            'category' => $request->category,
            'jersey_size' => $request->jersey_size,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Data Peserta berhasil diperbarui.');
    }
}
