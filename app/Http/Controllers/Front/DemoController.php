<?php

namespace App\Http\Controllers\Front;

/**原生函式**/

use Illuminate\Http\Request;
use View;
use ItemMaker;
use Cache;
use Excel;
use DateTime;
use Redirect;
use Mail;
use Session;
use Validator;
use Config;
use Hash;

use UnitMaker;
use TableMaker;
use BaseFunction;
use FrontBase;
use Carbon\Carbon;

/**相關Controller**/

use App\Http\Controllers\Controller;

/**相關repository**/

/**相關Models**/

/**相關Service**/



class DemoController extends FrontBase
{
    protected static $seo;

    public function __construct()
    {
        parent::__construct();
    }

    public function index($branch, $locale, $id)
    {
        $data = config('models.Demo')::isVisible(0)->whereId($id)->with('DemoArticle.DemoArticleThree')->first();
        return View::make(
            'Front.demo.index',
            [
                'data' => $data,
            ]
        );
    }
}
