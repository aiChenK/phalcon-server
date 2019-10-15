<?php

namespace app\helpers;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use app\helpers\Exception\DBException;

class BaseModel extends Model
{

    protected $operatorId;

    /**
     * 初始化软删除
     *
     * create by ck 20191014
     */
    public function initialize()
    {
        $this->useDynamicUpdate(true);
//        $this->keepSnapshots(false);
//        if (property_exists($this, 'isDel')) {
//            $this->addBehavior(new SoftDelete([
//                'field' => 'isDel',
//                'value' => 1,
//            ]));
//        }
    }

    /**
     * 获取保存错误原因
     *
     * @return string
     *
     * create by ck 20181121
     */
    public function getError()
    {
        $message = parent::getMessages()[0];
        return $message->getMessage();
    }

    /**
     * 保存或抛出异常
     *
     * @param string $tip
     * @return bool
     * @throws DBException
     *
     * create by ck 20191014
     */
    public function saveOrThrow($tip = '保存失败')
    {
        if (!$this->save()) {
            throw new DBException($tip, $this->getError());
        }
        return true;
    }

    /**
     * 根据id删除记录
     *
     * @param $ids
     * @return mixed
     * @throws \Exception
     *
     * modify by ck 20191014
     */
//    public static function deleteById(array $ids)
//    {
//        if (!$ids) {
//            throw new \Exception('缺少id');
//        }
//        return self::find([
//            'conditions' => "isDel = 0 AND id IN ({idArr:array})",
//            'bind'       => ['idArr' => $ids]
//        ])->delete();
//    }

    /**
     * 分页获取数据
     *
     * @param array $parameters
     * @param int $page
     * @param int $size
     * @return array
     *
     * create by ck 20190116
     */
    public static function runPage($parameters = [], $page = 1, $size = 50)
    {
        if (is_string($parameters)) {
            $parameters = [
                'conditions' => $parameters
            ];
        }
        $total = self::count($parameters);
        $total = is_int($total) ? $total : count($total->toArray());
        $parameters['limit'] = [
            'number' => $size,
            'offset' => $size * ($page - 1)
        ];
        $rows = self::find($parameters)->toArray();
        return [
            'page'      => $page,
            'totalPage' => ceil($total / $size),
            'size'      => $size,
            'total'     => $total,
            'rows'      => $rows
        ];
    }

    /**
     * 创建前记录最后修改时间及操作人
     *
     * @return bool
     *
     * create by ck 20181121
     * modify by ck 20190710
     */
//    public function beforeCreate()
//    {
//        $time = time();
//        if (property_exists($this, 'isDel')) {
//            $this->writeAttribute('isDel', 0);
//        }
//        if (property_exists($this, 'createAt')) {
//            $this->writeAttribute('createAt', $time);
//        }
//        if (property_exists($this, 'createBy')) {
//            $this->writeAttribute('createBy', $this->getOperatorId());
//        }
//        if (property_exists($this, 'updateAt')) {
//            $this->writeAttribute('updateAt', $time);
//        }
//        if (property_exists($this, 'updateBy')) {
//            $this->writeAttribute('updateBy', $this->getOperatorId());
//        }
//        return true;
//    }

    /**
     * 更新前记录最后修改时间及操作人
     *
     * @return bool
     *
     * create by ck 20181121
     */
//    public function beforeUpdate()
//    {
//        if (property_exists($this, 'updateAt')) {
//            $this->writeAttribute('updateAt', time());
//        }
//        if (property_exists($this, 'updateBy')) {
//            $this->writeAttribute('updateBy', $this->getOperatorId());
//        }
//        return true;
//    }

    /**
     * 删除前记录最后修改时间及操作人
     *
     * @return bool
     *
     * create by ck 20181121
     */
//    public function beforeDelete()
//    {
//        $this->beforeUpdate();
//        return true;
//    }

    /**
     * 设置操作人id
     *
     * @param int $userId
     * @return $this
     *
     * create by ck 20190710
     */
    public function setOperatorId($userId = 0)
    {
        $this->operatorId = $userId;
        return $this;
    }

    /**
     * 获取操作人id
     *
     * @return int
     *
     * create by ck 20190710
     */
    protected function getOperatorId()
    {
        return $this->operatorId;
    }

}
