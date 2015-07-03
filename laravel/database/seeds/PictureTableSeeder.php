<?php

use Illuminate\Database\Seeder;
use App\Picture;
  
class PictureTableSeeder extends Seeder {
    public function run() {
	
		Picture::truncate();
		
		Picture::create( [
		    'url' => "files/pictures/2010-10-02-330546.jpeg"
		] );

		Picture::create( [
		    'url' => "files/pictures/2011-07-12-421113.jpeg"
		] );

		Picture::create( [
		    'url' => "files/pictures/Axis.Powers:.Hetalia.full.1459842.jpg"
		] );

		Picture::create( [
		    'url' => "files/pictures/D..Brothers.full.1142596.jpg"
		] );

		Picture::create( [
		    'url' => "files/pictures/Heart.Pirates.full.1174175.jpg"
		] );

		Picture::create( [
		    'url' => "files/pictures/Hunter.x.Hunter.full.1001871.jpg"
		] );

	}
}