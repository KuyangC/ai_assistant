<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Activity;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('finance', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
            'date' => $request->date,
        ]);

        // Log activity
        $typeText = $request->type === 'income' ? 'Pemasukan' : 'Pengeluaran';
        Activity::log(
            'transaction',
            'created',
            "{$typeText} ditambah: \"{$request->description} - Rp " . number_format($request->amount, 0, ',', '.') . "\"",
            'fas fa-plus'
        );

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
            'date' => $request->date,
        ]);

        // Log activity
        $typeText = $request->type === 'income' ? 'Pemasukan' : 'Pengeluaran';
        Activity::log(
            'transaction',
            'updated',
            "{$typeText} diperbarui: \"{$request->description} - Rp " . number_format($request->amount, 0, ',', '.') . "\"",
            'fas fa-edit'
        );

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Log activity before deletion
        $typeText = $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran';
        Activity::log(
            'transaction',
            'deleted',
            "{$typeText} dihapus: \"{$transaction->description} - Rp " . number_format($transaction->amount, 0, ',', '.') . "\"",
            'fas fa-trash'
        );

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}