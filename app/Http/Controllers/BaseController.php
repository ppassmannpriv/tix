<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BaseController extends AbstractController
{
	public function index() : View
	{
		return view('base.index', [
			'baseFrontendConfig' => $this->config->getFrontendConfig()
		]);
	}
}
