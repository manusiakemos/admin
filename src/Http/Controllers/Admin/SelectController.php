<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class SelectController extends Controller
{
    public function __invoke(Request $request, $case)
    {
        switch ($case){
            case 'boolean':
                return [
                    ['value' => 1, 'text' =>'Ya'],
                    ['value' => 0, 'text' =>'Tidak'],
                ];
                break;
            case 'boolean_active':
                return [
                    ['value' => 1, 'text' =>'Aktif'],
                    ['value' => 0, 'text' =>'Nonaktif'],
                ];
                break;
        }
    }
}
