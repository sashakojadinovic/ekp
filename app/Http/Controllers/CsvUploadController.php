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
            $reader->date_of_birth = $r[3] !== '' ? $r[3] : null;
            $reader->parents_name = $r[4];
            $reader->address = $r[5];
            $reader->phone_number = $r[6];
            $reader->occupation = $r[7];
            $reader->email = $r[8];
            if ($r[9] === "ž") {
                $reader->gender = 0;
            } else if ($r[9] === "m") {
                $reader->gender = 1;
            } else {
                $reader->gender = -1;
            }
            $reader->city = $r[10];
            $reader->city_code = $r[11];
            //dd($reader);
            $reader->save();
        }
    }
    private function saveBooks($books)
    {
        //dd($books);

        foreach ($books as $b) {
            //
            $authors = [];
            $publisher = null;
            $donator = null;

            if ($b[0] !== "") {
                //dd("!==empty");
                $authors = explode(';', $b[0]);
            } else {
                //dd("===empty");
                //$authors = [];
            }

            $book = new Book;
            $book->title = $b[1];
            if($b[6]){
                $book->age=$b[6];
            }
            $book->save();
            $book->categories()->attach($b[5]);
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
            if ($b[3] !== "") { //Publisher
                if ($publisher = Publisher::where('name', '=', $b[3])->first()) {
                    $book->publishers()->attach($publisher->id);
                } else {
                    $newPublisher = new Publisher;
                    $newPublisher->name = $b[3];
                    $newPublisher->save();
                    $book->publishers()->attach($newPublisher->id);
                }
            }

            $item = new Item;
            $item->signature = $b[2];
            $item->available = 1;

            $item->book()->associate($book->id);

            if ($b[4] !== "") { //Donator
                if ($donator = Donator::where('name', '=', $b[4])->first()) {
                    $item->donator()->associate($donator->id);
                } else {
                    $donator = new Donator;
                    $donator->name = $b[4];
                    $donator->save();
                    $item->donator()->associate($donator->id);
                }
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
