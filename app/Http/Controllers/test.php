<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class test extends Controller
{
    public function test(){
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight(150);
        $renderer->setWidth(150);
        $writer = new \BaconQrCode\Writer($renderer);
        $writer->writeFile('Hello Tessssst!', 'images/qrcode.png');

    }
}
