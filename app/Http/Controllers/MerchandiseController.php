<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shop\Entity\Merchandise;
use Dotenv\Validator;

class MerchandiseController extends Controller
{
    public function merchandiseCreatProcess(){

        $merchandise_data = [
            'status'            => 'C',
            'name'              => '',
            'name_en'           => '',
            'introduction'      => '',
            'introduction_en'   => '',
            'photo'             => null,
            'price'             => 0,
            'remin_count'       =>0,
        ];
        $Merchandise = Merchandise::creat($merchandise_data);

        return redirect('merchandise/' . $Merchandise->id . '/edit');
    }
}
