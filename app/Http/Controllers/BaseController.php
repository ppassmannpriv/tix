<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Base\Config;
use Illuminate\View\View;

class BaseController extends Controller
{
	private $config;

	public function __construct(
		Config $config
	)
	{
		$this->config = $config;
	}

	public function index() : View
	{
		return view('base.index', [
			'baseFrontendConfig' => $this->config->getFrontendConfig()
		]);
	}
}
