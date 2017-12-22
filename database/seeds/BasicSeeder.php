<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use \DB as DB;

class BasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // inserta clientes nuevos
        $clients = [];
        for($i = 0; $i < 100; $i++){
            $clients[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber
            ];
        }
        DB::table('clients')->insert($clients); // inserta clientes nuevos

        // autores
        // se encarga de convertir a un usuario en author
        $total_users = count(DB::table('users')->get()); // numero total de usuarios
        $authors = [];
        for($i = 0; $i < 100; $i++){
            $authors[] = [
                'nickname' => ucfirst($faker->word), // primera dletra en mayuscula
                'user_id' => $faker->numberBetween(1, $total_users)
            ];
        }
        DB::table('authors')->insert($authors);// inserta authores en base de datos

        // themes
        $themes = [];
        for($i = 0; $i < 100; $i++){
            $themes[] = [
                'name' => strtoupper($faker->word), // en mayusculas
                'description' => $faker->text
            ];
        }
        DB::table('themes')->insert($themes);// inserta authores en base de datos

        
        // books
        // inserta libros nuevos
        $books = [];
        for($i = 0; $i < 100; $i++){
            $books[] = [
                'title' => strtoupper($faker->text(20)), // en mayusculas
                'resume' => $faker->text,
                'unit_price' => $faker->randomFloat(2, 2, 400),
                'area_id' => $faker->numberBetween(1, 3)
            ];
        }
        DB::table('books')->insert($books);// inserta authores en base de datos

        
        // book themes
        // inserta los temas de libros
        $total_books = count(DB::table('books')->get()); // numero total de libros
        $total_themes = count(DB::table('themes')->get()); // numero total de temas
        // $total_authors = count(DB::table('authors')->get()); // numero total de authors
        $book_themes = [];
        for($i = 0; $i < 100; $i++){
            $book_themes[] = [
                'book_id' => $faker->numberBetween(1, $total_books),
                'theme_id' => $faker->numberBetween(1, $total_themes)
            ];
        }
        DB::table('book_themes')->insert($book_themes);// inserta authores en base de datos


        // book authors
        // inserta los autores de los libros
        $total_authors = count(DB::table('authors')->get()); // numero total de authors
        $book_authors = [];
        // inserta por lo menos un autor a cda libro
        // inserta autores adicionales
        for($i = 1; $i <= $total_books; $i++){
            $book_authors[] = [
                // 'book_id' => $faker->numberBetween(1, $total_books),
                'book_id' => $i,
                'author_id' => $faker->numberBetween(1, $total_authors)
            ];
        }
        for($i = 0; $i < 100; $i++){
            $book_authors[] = [
                'book_id' => $faker->numberBetween(1, $total_books),
                'author_id' => $faker->numberBetween(1, $total_authors)
            ];
        }
        DB::table('book_authors')->insert($book_authors);// inserta authores en base de datos
    }
}
