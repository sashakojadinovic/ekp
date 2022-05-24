<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Item;
use App\Models\Donator;
use App\Models\Publisher;
use App\Models\Reader;
use Illuminate\Http\Request;

class CsvUploadController extends Controller
{
    //
    public function index()
    {
        return view('csvupload.csvupload');
    }
    private function saveReaders($readers)
    {
        //dd($readers);
        foreach ($readers as $r) {
            if (Reader::where('card_id', '=', $r[0])->first()) {
                continue;
            }
            $reader = new Reader;
            $reader->card_id = $r[0];
            $reader->name = $r[2] . " " . $r[1];
            $reader->date_of_birth = $r[3]!==''?$r[3]:null;
            $reader->parents_name = $r[4];
            $reader->address = $r[5];
            $reader->phone_number = $r[6];
            $reader->occupation =$r[7];
            $reader->email = $r[8];
            if ($r[9] === "ž") {
                $reader->gender = 0;
            } else if ($r[9] === "m") {
                $reader->gender = 1;
            } else {
                $reader->gender = -1;
            }
            $reader->city =$r[10];
            $reader->city_code=$r[11];
            //dd($reader);
            $reader->save();
        }
    }
    private function saveBooks($books)
    {
        //dd($books);

        foreach ($books as $b) {
            //
            $authors = explode(';', $b[1]);
            $book = new Book;
            $book->title = $b[0];
            $book->year = $b[3];
            $book->age = $b[4];
            $book->info = $b[5];

            $publisher = Publisher::where('name', '=', $b[2])->first();
            $book->save();
            $book->categories()->attach(1);
            foreach ($authors as $a) {
                $author = Author::where('name', '=', $a)->first();
                if ($author) {
                    $book->authors()->attach($author->id);
                } else {
                    $newAuthor = new Author;
                    $newAuthor->name = $a;
                    $newAuthor->save();
                    $book->authors()->attach($newAuthor->id);
                }
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
    }
    public function uploadCsv(Request $request)
    {
        $csvarray = [];
        $file = fopen($request->file('csv'), 'r');
        while (($data = fgetcsv($file, 1000, ",")) !== false) {
            $csvarray[] = $data;
        }
        fclose($file);
        if ($request->category === "Author") {
            $this->saveReaders($csvarray);
            return redirect('/readers');
        } else if ($request->category === "Book") {
            $this->saveBooks($csvarray);
            return redirect('/books');
        }
    }
}
