<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Report;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function list() : JsonResponse
    {
        $books = Report::with('author')->get();

        $data = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'name' => $book->name,
                'author' => $book->author->name,
                'quantity' => $book->quantity,
                'created_at' => $book->created_at,
                'updated_at' => $book->updated_at,
            ];
        });

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function byId($id) : JsonResponse
    {
        return response()->json([
            'data' => Report::find($id)
        ], 200);
    }

    public function update(ReportRequest $request, $id) : JsonResponse
    {
        $validated = $request->validated();

        $book = Report::query()->find($id);

        if ($book) {
            $book->update([
                'name' => $validated['name'],
                'author_id' => $validated['author_id']
            ]);

            return response()->json([
                'message' => 'Книга успешно обновлена',
                'data' => $book
            ], 200);
        } else {
            return response()->json([
                'message' => 'Книга не найдена'
            ], 404);
        }
    }

    public function destroy($id) : JsonResponse
    {
        Report::find($id)->delete();
        return response()->json(['message' => 'Книга удалена'], 204);
    }
}
