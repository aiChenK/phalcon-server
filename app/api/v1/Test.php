<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-09-26
 * Time: 10:31
 */

namespace app\api\v1;

use app\api\Base;

class Test extends Base
{

    public function index()
    {
        return $this->success('Congratulations!');
    }

    public function indexPost()
    {
        return $this->success('Congratulations! Method: POST');
    }
}