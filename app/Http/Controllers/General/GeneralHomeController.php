<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class GeneralHomeController extends Controller
{
    public function index()
    {
        $fields = Field::take(6)->get();
        return view('general.pages.home.index', [
            'title' => 'Beranda',
            'fields' => $fields,
        ]);
    }
}
