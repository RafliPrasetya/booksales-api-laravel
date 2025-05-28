<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!"
            ], 200);
        }
        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $transactions
        ], 200);
    }

    public function store(Request $request)
    {
        // 1. Validator & cek validasi
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Generate orderNumber unik
        $lastTransaction = Transaction::orderBy('id', 'desc')->first();
        $orderNumber = 'ORD-' . str_pad(($lastTransaction->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);

        // 3. Ambil user yang sedang login
        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized user.'
            ], 401);
        }

        // 4. Cari data buku
        $book = Book::find($request->book_id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found.'
            ], 404);
        }

        // 5. Cek stok buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok Barang Tidak Cukup.'
            ], 400);
        }

        // 6. Hitung total harga
        $totalAmount = $book->price * $request->quantity;

        // 7. Kurangi stok buku
        $book->stock -= $request->quantity;
        $book->save();

        // 8. Simpan data transaksi
        $transaction = Transaction::create([
            'order_number' => $orderNumber,
            'customer_id' => $user->id,
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully.',
            'data' => $transaction
        ], 201);
    }
    
    public function show($id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaction details retrieved successfully.',
            'data' => $transaction
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        // Validator untuk update (boleh sesuaikan fields yang bisa diupdate)
        $validator = Validator::make($request->all(), [
            'book_id' => 'exists:books,id',
            'quantity' => 'integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Jika ingin update book_id dan quantity, lakukan validasi stok dan hitung ulang total_amount
        if ($request->has('book_id')) {
            $book = Book::find($request->book_id);
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'Book not found.'
                ], 404);
            }
        } else {
            $book = $transaction->book;
        }

        $quantity = $request->quantity ?? $transaction->quantity;

        if ($book->stock + $transaction->quantity < $quantity) {
            // Karena transaksi lama mengurangi stok sebelumnya, kita tambahkan dulu stok lama sebelum cek stok baru
            return response()->json([
                'success' => false,
                'message' => 'Stok buku tidak cukup untuk update transaksi.'
            ], 400);
        }

        // Update stok: kembalikan stok lama dulu, lalu kurangi stok baru
        $book->stock += $transaction->quantity; // kembalikan stok lama
        $book->stock -= $quantity; // kurangi stok baru
        $book->save();

        // Update data transaksi
        $transaction->book_id = $book->id;
        $transaction->quantity = $quantity;
        $transaction->total_amount = $book->price * $quantity;
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully.',
            'data' => $transaction
        ], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }
        // Kembalikan stok buku saat hapus transaksi
        $book = $transaction->book;
        $book->stock += $transaction->quantity;
        $book->save();

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully.'
        ], 200);
    }
}
