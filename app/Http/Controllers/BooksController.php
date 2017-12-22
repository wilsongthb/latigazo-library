<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Themes;
use App\Models\Areas;
use App\Models\Authors;
use DB;

class BooksController extends Controller
{
    /**
     * borrar author
     */
    public function deleteAuthor($id){
        DB::table('book_authors')
            ->where('id', $id)
            ->delete();
        return redirect()->back();
    }
    
    /**
     * borrar tema
     */
    public function deleteTheme($id){
        DB::table('book_themes')
            ->where('id', $id)
            ->delete();
        return redirect()->back();
    }

    /**
     * Agrega un author
     */
    public function addAuthor($book_id){
        // dd(request()->all());
        DB::table('book_authors')->insert(
            ['book_id' => $book_id, 'author_id' => request()->author_id]
        );
        return redirect('books/'.$book_id.'/edit');
    }
    /**
     * Agregar un tema
     */
    public function addTheme($book_id){
        // dd(request()->all());
        DB::table('book_themes')->insert(
            ['book_id' => $book_id, 'theme_id' => request()->theme_id]
        );
        return redirect('books/'.$book_id.'/edit');
    }

    /**
     * cargar con autores y temas a un libro
     */
    public function loadRelationals(
        &$book // el & es para definir un parametro por referencia
        /**
         * se requiere para que los cambios 
         * realizados se guarden en el parametro recibido
         * ose dentro del libro
         */
    ){
        $authors = Authors
            ::select(
                'au.*',
                'ba.id AS ba_id'
            )
            ->from('authors AS au')
            ->leftJoin('book_authors AS ba', 'au.id', 'ba.author_id')
            ->where('ba.book_id', $book->id)
            ->get();

        $book->authors = $authors; // le guarda la lista de autores

        $themes = Themes
            ::select(
                't.*',
                'bt.id AS bt_id'
            )
            ->from('themes AS t')
            ->leftJoin('book_themes AS bt', 't.id', 'bt.theme_id')
            ->where('bt.book_id', $book->id)
            ->get();

        $book->themes = $themes; // le guarda la lista de temas
    }

    /**
     * selecciona a un solo libro
     */
    public function select($id){
        // sirve para obtener un libro por su id, ademas
        // le incluye el area
        $book = Books
            ::select(
                'b.*',
                'a.name AS area'
            )
            ->from('books AS b')
            ->leftJoin('areas AS a', 'a.id', 'b.area_id')
            ->where('b.id', $id)
            ->first(); // selecciona el primero de los resultados
        
        $this->loadRelationals($book); // para cargarlo con sus autores y temas
        
        return $book;
    }


    /**
     * Crea un a lista de libros
     * la lista esta paginada
     */
    public function getList(){
        $books = Books
            ::select(
                'b.*',
                'a.name AS area'
            )
            ->from('books AS b')
            ->leftJoin('areas AS a', 'a.id', 'b.area_id')
            ->orderBy('b.id', 'DESC');

        // aqui se realiza la busqueda
        if(request()->buscar){
            $buscar = request()->buscar;
            $books = $books
                ->Where('b.title', 'LIKE', "%$buscar%")
                ->orWhere('a.name', 'LIKE', "%$buscar%");    
        }
        // buscar por autor
        if(request()->author_id){
            $books = $books
                ->leftJoin('book_authors AS ba', 'ba.book_id', 'b.id')
                ->leftJoin('authors AS au', 'au.id', 'ba.author_id')
                ->where('au.id', request()->author_id);
        }
        // buscar por tema
        if(request()->theme_id){
            $books = $books
                ->leftJoin('book_themes AS bt', 'bt.book_id', 'b.id')
                ->leftJoin('themes AS t', 't.id', 'bt.theme_id')
                ->where('t.id', request()->theme_id);
        }

        // buscar por area
        if(request()->area_id){
            $books = $books
                ->where('a.id', request()->area_id);
        }
        
        $books = $books->paginate(15); // 15 por pagina

        foreach (
            $books->items() // lista de resultados de la seleccion anterior, es un array de objetos
            as 
            $key => &$value // & es para definir que cada una de las filas se pasa por referencia
            // $value representa a cada una de las filas del resultado
            // el simbolo & permito que las modificaciones que hacemos
            // dentro del foreach se guarden en el array original
        ) {
            // cargar con autores y temas
            $this->loadRelationals($value);
        }

        /// sirven para debugear, usar solo en desarrollo
        // dd($books->items());
        // dd($books);

        // retorna la lista de libros cargados con sus autores y temas
        return $books;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->getList();
        return view('books.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd($this->select($id));
        return view('books.create', [
            'areas' => Areas::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        $book = new Books;
        $book->title = $request->title;
        $book->resume = $request->resume;
        $book->area_id = $request->area_id;
        $book->unit_price = $request->unit_price;
        $book->save();
        return redirect('books/'.$book->id.'/edit');
        // dd('Creado :D');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($this->select($id));
        return view('books.show', [
            'book' => $this->select($id),
            'areas' => Areas::get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($this->select($id));
        return view('books.edit', [
            'book' => $this->select($id),
            'areas' => Areas::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $book = Books::find($id);
        $book->title = $request->title;
        $book->resume = $request->resume;
        $book->unit_price = $request->unit_price;
        $book->area_id = $request->area_id;
        $book->save();
        // return redirect('books/'.$book->id.'/edit');
        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Books::destroy($id);
        return redirect('books');
    }
}
