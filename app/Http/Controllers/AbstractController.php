<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Base\Config;

abstract class AbstractController extends Controller
{
	protected $config;

	public function __construct(
		Config $config
	)
	{
		$this->config = $config;
	}

}
