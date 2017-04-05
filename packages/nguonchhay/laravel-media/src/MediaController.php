<?php
namespace Nguonchhay\LaravelMedia;

use App\Http\Controllers\Controller;

class MediaController extends Controller {

	public function index() {
		return view('nguonchhay-laravel.medias.index');
	}
}
