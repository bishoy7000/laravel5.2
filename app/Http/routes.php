<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/	use GDText\Box;
	use GDText\Color;
    use Johntaa\Arabic\I18N_Arabic;;

Route::get('/', function () {
    return view('welcome');
});
Route::get('test', function(){
      	$img = Image::make(public_path('images/test2.png'));  
       	$img->text('This is an example writing ',($img->width())/2,($img->height())/2, function($font){
       	$font->file(public_path('fonts/Aaargh.ttf'));
       	$font->size(10);  
        $font->color('#000000');  
		$font->align('center');
    	$font->valign('middle');
       	}); 
       	//echo $img->response();
		$filename  = 'new.png';
		$path = public_path('images/' . $filename);
		return $img->response('png', 70);
		echo $data;
	    //$img->save($path);  
	           	//return view('test', compact('filename'));
});

//Route::get('test2', function(){
//		$im = imagecreatetruecolor(500, 500);
//		$backgroundColor = imagecolorallocate($im, 0, 18, 64);
//		imagefill($im, 0, 0, $backgroundColor);
//		$im = imagecreatefrombmp(public_path('images/test2.png'));
//		$box = new Box($im);
//		$box->setFontFace(public_path('fonts/Aaargh.ttf')); // http://www.dafont.com/minecraftia.font
//		$box->setFontColor(new Color(255, 75, 140));
//		$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
//		$box->setFontSize(8);
//		$box->setLineHeight(1.5);
//		//$box->enableDebug();
//		$box->setBox(20, 20, 460, 460);
//		$box->setTextAlign('left', 'top');
//		$box->draw(
//		    "    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend congue auctor. Nullam eget blandit magna. Fusce posuere lacus at orci blandit auctor. Aliquam erat volutpat. "
//		);
//		header("Content-type: image/png;");
//		imagepng($im, null, 9, PNG_ALL_FILTERS);
//});

Route::get('test3', function(){
	$textToBeShown ="تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست تيست  ";
	$img2 = Image::make(public_path('images/test4.jpg'));
	// inserts character where string is to be split into new line (after 15 characters, keeping words intact)
	$string = wordwrap($textToBeShown,40,"|");
	//create array of lines
	$strings = explode("|",$string);
	$i=($img2->height())/3; //top position of string
	//for each line added
	foreach($strings as $string){
		$img2->text($string, ($img2->width())/2, $i, function($font) {
       	$font->file(public_path('fonts/trado.ttf'));
		$font->size(20);
		$font->color('#000000');
		$font->align('center');
		$font->valign('top');
	});
		$i=$i+($img2->height()/100)*7; //shift top postition down 42
	}
	return $img2->response('png', 70);
});

//Route::get('test4', function(){
//    $Arabic = new I18N_Arabic('Glyphs');
//    $name = $Arabic->utf8Glyphs("man Hello there Hello there Hello there Hello there Hello there Hello there lady");
//    $textToBeShown ="The man, the dwarf and the girlguardian mirror mirror on the wal on the wall who's gonna be ";
//    $img2 = Image::make(public_path('images/test4.jpg'));
//    // inserts character where string is to be split into new line (after 15 characters, keeping words intact)
//    echo $name;
//    $string = wordwrap($name,20,"|");
//    //echo $string;
//    //create array of lines
//    $strings = explode("|",$string);
//    dd($strings);
//    $i=($img2->height())/3; //top position of string
//    //for each line added
//    foreach($strings as $string){
//        $img2->text($string, ($img2->width())/2, $i, function($font) {
//            $font->file(public_path('fonts/trado.ttf'));
//            $font->size(50);
//            $font->color('#000000');
//            $font->align('center');
//            $font->valign('top');
//        });
//        $i=$i+(($img2->height()/100)*7);
//    }
//    return $img2->response('png', 70);
//});


Route::get('test4', function () {
    $Arabic = new I18N_Arabic('Glyphs');
//    $name = $Arabic->utf8Glyphs("Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test ");
    //$name = $Arabic->utf8Glyphs(" ");
    $name = "Hello there it's supposed to be  working at the moment ha yala n4ouf";
//    $name = "The man, the dwarf and the girlguardian mirror mirror on the wal on the wall who's gonna be ";
    $img2 = Image::make(public_path('images/test4.jpg'));
    // inserts character where string is to be split into new line (after 15 characters, keeping words intact)
    $string = wordwrap($name, 30, "|"); // : /n
    //create array of lines
    $strings = explode("|", $string);
    $i = ($img2->height()) / 2; //top position of string

    //for each line added
    foreach ($strings as $string) {//available
        $img2->text($string, $img2->width()/3, $i, function ($font) {
            $font->file(public_path('fonts/trado.ttf'));
            $font->size(30);
            $font->color('#EC1E1E');
            $font->valign('center');
            $font->align('bottom');
            /*$font->angle(80);*/
        });
        $i = $i + ($img2->height() / 100) * 7; //shift top postition down 42
    }
    // dd($img2->response('jpg',100)) ;
    $img2->insert(public_path('images/qrcode.png'), 'bottom-right', 20, 20);
    return $img2->response('jpg', 100);
});

Route::get('test5', function (){
    $renderer = new \BaconQrCode\Renderer\Image\Png();
    $renderer->setHeight(150);
    $renderer->setWidth(150);
    $writer = new \BaconQrCode\Writer($renderer);
    $writer->writeFile('Hello Tessssst!', 'images/qrcode.png');
});

Route::get('test6', 'test@test');