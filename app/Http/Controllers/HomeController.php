<?php

namespace App\Http\Controllers;

use App\Http\Migrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $table_name = Str::plural($request->name);

        $model = ucwords($request->name);

        if(!class_exists('App\\Models\\' . $model)) Artisan::call('make:model ' . $model);

        if(Schema::hasTable($table_name)) return back()->with('error', 'Sorry, table already exists');

        Migrator::create($table_name);

        Artisan::call('migrate');

        return back()->with('success', 'Table Created Successfully');
    }
}
