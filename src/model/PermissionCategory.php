<?php
/**
 * Created by WeiYongQiang.
 * User: weiyongqiang <hayixia606@163.com>
 * Date: 2019-04-17
 * Time: 22:50
 */

namespace gmars\rbac\model;


use think\Exception;

class PermissionCategory extends Base
{

    /**
     * 编辑权限分组
     * @param $data
     * @return $this
     * @throws Exception
     */
    public function saveCategory($data = [])
    {
        if (!empty($data)) {
            $this->data($data);
        }
        $validate = new \gmars\rbac\validate\PermissionCategory();
        if (!$validate->check($this)) {
            throw new Exception($validate->getError());
        }
        $data = $this->getData();
        if (isset($data['id']) && !empty($data['id'])) {
            $this->isUpdate(true);
        }
        $this->save();
        return $this;
    }

    /**
     * 删除权限分组
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delCategory($id)
    {
        $where = [];
        if (is_array($id)) {
            $where[] = ['id', 'IN', $id];
        } else {
            $id = (int)$id;
            if (is_numeric($id) && $id > 0) {
                $where[] = ['id', '=', $id];
            } else {
                throw new Exception('删除条件错误');
            }
        }

        if ($this->where($where)->delete() === false) {
            throw new Exception('删除权限分组出错');
        }
        return true;
    }

}