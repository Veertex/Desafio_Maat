<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportCollection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*SE GENERAN COLECCIONES VACIAS EN DONDE ALMACENAR
        USUARIOS Y POSIBLES EXCEPCIONES*/
        $users = collect([]);
        $usersPerMonth = collect([]);
        $exception = null;

        /*TRANSACCION EN BASE DE DATOS PARA OBTENER USUARIOS
        Y CONTROLAR ERRORES*/
        try {
            /*COLLECION DE USUARIOS POR MES*/
            DB::transaction(function () use (&$usersPerMonth) {
                $usersPerMonth = collect(DB::select('SELECT DATE_FORMAT(created_at, "%Y-%m") AS date,
                COUNT(*) AS users FROM users GROUP BY DATE_FORMAT(created_at, "%Y-%m")'));
            }, 1);

            /*COLLECION DE TODOS LOS USUARIOS*/
            DB::transaction(function () use (&$users) {
                $users = collect(DB::select('SELECT * FROM USERS'));
            }, 1);
        } catch (Exception $e) {
            $exception = dd($e);
        }

        /*SE RETORNA LA VISTA CON LA COLLECION DE USUARIOS*/
        return view('index', ['users' => $users, 'usersPerMonth' => $usersPerMonth, 'exception' => $exception]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //SE DECLARAN LAS REGLAS
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];

        //SE DECLARAN LOS MENSAJES PERSONALIZADOS
        $messages = [
            'name.required' => 'Nombre requerido',
            'email.required' => 'Email requerido',
            'password.required' => 'Contraseña requerida',
        ];

        //SE CREA EL VALIDADOR
        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        //SE EJECUTA LA VALIDACION
        $validated = $validator->validate();

        /*SE GENERAN VARIABLE EN DONDE ALMACENAR POSIBLES
        EXCEPCIONES*/
        $exception = null;

        /*TRANSACCION EN BASE DE DATOS PARA GUARDAR DATOS
        VALIDADOS Y CONTROLAR ERRORES*/
        try {
            DB::transaction(function () use ($validated) {
                $name = $validated["name"];
                $email = $validated["email"];
                $password = $validated["password"];
                $created_at = now();
                $updated_at = now();

                DB::insert('INSERT INTO users (name, email, password, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?)', [$name, $email, $password, $created_at, $updated_at]);
            }, 1);
        } catch (Exception $e) {
            $exception = dd($e);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        /*SE GENERAN VARIABLE EN DONDE ALMACENAR EL USUARIO 
        Y POSIBLES EXCEPCIONES*/
        $user = null;
        $exception = null;

        /*TRANSACCION EN BASE DE DATOS PARA GUARDAR DATOS
        VALIDADOS Y CONTROLAR ERRORES*/
        try {
            DB::transaction(function () use (&$user, $id) {
                $user = DB::select('SELECT * FROM USERS WHERE id = ?', [$id]);
            }, 1);
        } catch (Exception $e) {
            $exception = dd($e);
        }

        return view('edit', ['user' => $user[0]]);
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
        //SE DECLARAN LAS REGLAS
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];

        //SE DECLARAN LOS MENSAJES PERSONALIZADOS
        $messages = [
            'name.required' => 'Nombre requerido',
            'email.required' => 'Email requerido',
            'password.required' => 'Contraseña requerida',
        ];

        //SE CREA EL VALIDADOR
        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        //SE EJECUTA LA VALIDACION
        $validated = $validator->validate();

        /*SE GENERAN VARIABLE EN DONDE ALMACENAR POSIBLES
        EXCEPCIONES*/
        $exception = null;

        /*TRANSACCION EN BASE DE DATOS PARA GUARDAR DATOS
        VALIDADOS Y CONTROLAR ERRORES*/

        try {
            DB::transaction(function () use ($validated, $id) {
                $name = $validated["name"];
                $email = $validated["email"];
                $password = $validated["password"];
                $updated_at = now();

                DB::update('UPDATE users SET name = ?, email = ?, password = ?, updated_at = ?
                WHERE id = ?', [$name, $email, $password, $updated_at, $id]);
            }, 1);
        } catch (Exception $e) {
            $exception = dd($e);
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*SE GENERA UNA COLECCION VACIA EN DONDE ALMACENAR
        POSIBLES EXCEPCIONES*/
        $exception = null;

        /*TRANSACCION EN BASE DE DATOS PARA OBTENER USUARIO
        Y CONTROLAR ERRORES*/
        try {
            DB::transaction(function () use ($id) {
                $user = DB::select('DELETE FROM users WHERE id = ?', [$id]);
            }, 1);
        } catch (Exception $e) {
            $exception = dd($e);
        }
    }

    public function downloadUsersExcel()
    {
        /*SE GENERA UNA COLECCION VACIA EN DONDE ALMACENAR
        USUARIOS Y POSIBLES EXCEPCIONES*/
        $users = collect([]);
        $exception = null;

        /*TRANSACCION EN BASE DE DATOS PARA OBTENER USUARIOS
        Y CONTROLAR ERRORES*/
        try {
            DB::transaction(function () use (&$users) {
                $users = collect(DB::select('SELECT * FROM USERS'));
            }, 1);
        } catch (Exception $e) {
            $exception = dd($e);
        }

        /*SE GENERA Y DEVUELVE UN ARCHIVO .XLS CON
        LOS DATOS DE LA COLECCION*/
        return (new ExportCollection($users))->download('users.xlsx');
    }
}
