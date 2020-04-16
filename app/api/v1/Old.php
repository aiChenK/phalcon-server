<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-09-26
 * Time: 10:31
 */

namespace app\api\v1;

use app\api\Base;

class Old extends Base
{

    public function index()
    {
        return $this->success('Congratulations! - old');
    }
}