<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
class LibraryController extends Controller
{
public function index()
{
$books = Book::with('category')
->where('available_copies', '>', 0)
->latest()
->paginate(12);
    $categories = Category::withCount('books')->get();

    return view('frontend.index', compact('books', 'categories'));
}

public function bookDetail($id)
{
    $book = Book::with(['category', 'borrowings' => function($query) {
        $query->latest()->limit(5);
    }])->findOrFail($id);

    $relatedBooks = Book::where('category_id', $book->category_id)
        ->where('id', '!=', $book->id)
        ->limit(4)
        ->get();

    return view('frontend.book-detail', compact('book', 'relatedBooks'));
}

public function category($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $books = Book::where('category_id', $category->id)
        ->where('available_copies', '>', 0)
        ->paginate(12);

    return view('frontend.category', compact('category', 'books'));
}

public function search(Request $request)
{
    $query = $request->input('q');

    $books = Book::where(function($q) use ($query) {
        $q->where('title', 'like', "%{$query}%")
          ->orWhere('author', 'like', "%{$query}%")
          ->orWhere('isbn', 'like', "%{$query}%");
    })
    ->where('available_copies', '>', 0)
    ->paginate(12);

    return view('frontend.search', compact('books', 'query'));
}


}
