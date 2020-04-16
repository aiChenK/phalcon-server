<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-09-26
 * Time: 10:31
 */

namespace app\api\v1\index;

use app\api\Base;

class Index extends Base
{

    public function index()
    {
        return $this->success('Congratulations!  - ' . $this->apiRouter->getRequestPath());
    }

    public function indexPost()
    {
        return $this->success('Congratulations! Method: POST');
    }
}