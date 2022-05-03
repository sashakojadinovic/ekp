<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Item;
use App\Models\Donator;
use App\Models\Publisher;
use App\Models\Reader;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {
        return view('test.test');
    }
    public function create()
    {
        return view('test.test-create');
    }
    public function store(Request $request)
    {
        $readers = [];
        $file = fopen($request->file('csv'), 'r');
        while (($data = fgetcsv($file, 1000, ",")) !== false) {
            $readers[] = $data;
        }
        fclose($file);

        foreach ($readers as $r) {

            $reader = new Reader;
            $reader->card_id = $r[0];
            $reader->name = $r[2]." ".$r[1];
            $reader->address= $r[3];
            $reader->phone_number= $r[4];
            if($r[5]==="ž"){
                $reader->gender = 0;
            }
            else if($r[5]==="m"){
                $reader->gender = 1;
            }
            else{
                $reader->gender = -1;
            }
            $reader->save();



        }

        return redirect('readers');
    }
/*     public function store(Request $request)
    {
        $books = [];
        $file = fopen($request->file('csv'), 'r');
        while (($data = fgetcsv($file, 1000, ",")) !== false) {
            $books[] = $data;
        }
        fclose($file);

        foreach ($books as $b) {

            $book = new Book;
            $book->title = $b[0];
            $book->year = $b[3];
            $book->age = $b[4];
            $book->info = $b[5];
            $author = Author::where('name', '=', $b[1])->first();
            $publisher = Publisher::where('name', '=', $b[2])->first();
            $book->save();
            $book->categories()->attach(1);
            if ($author) {
                $book->authors()->attach($author->id);
            } else {
                $newAuthor = new Author;
                $newAuthor->name = $b[1];
                $newAuthor->save();
                $book->authors()->attach($newAuthor->id);
            }
            if ($publisher) {
                $book->publishers()->attach($publisher->id);
            } else {
                $newPublisher = new Publisher;
                $newPublisher->name = $b[2];
                $newPublisher->save();
                $book->publishers()->attach($newPublisher->id);
            }
            $item = new Item;
            $item->signature = $b[6];
            $item->available = 1;

            $item->book()->associate($book->id);

            $donator = Donator::where('name', '=', $b[7])->first();
            if ($donator) {
                $item->donator()->associate($donator->id);
            } else {
                $newDonator = new Donator;
                $newDonator->name = $b[7];
                $newDonator->save();
                $item->donator()->associate($newDonator->id);
            }
            $item->save();
        }

        return redirect('books');
    } */



}
