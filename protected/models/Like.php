<?php

class Like extends CFormModel
{

    public $params;

    public function setLike($id, $type, $status = 0)
    {
        $this->params = array(
            ':api_id' => $id,
            ':type' => $type == 'repo' ? 0 : 1
        );

        $this->_setUserId();

        return $this->_checkStatus();
    }

    private function _setUserId()
    {
        if ($cookie = Yii::app()->request->cookies['user_id']) {
            $this->params[':user_id'] = $cookie->value;
        } else {
            $this->params[':user_id'] = $this->_addNewUser();

            $cookie = new CHttpCookie('user_id', $this->params[':user_id']);
            $cookie->expire = time() + (86400 * 365);

            Yii::app()->request->cookies['user_id'] = $cookie;
        }
    }

    private function _addNewUser()
    {
        Yii::app()->db->createCommand()
                ->insert('users', array());

        $userId = Yii::app()->db->getLastInsertID();

        return $userId;
    }

    private function _checkStatus()
    {
        $status = $this->_getStatus();

        if ($status) {
            return 'UnLike';
        } else {
            return 'Like';
        }
    }

    private function _getStatus()
    {
        $row = Yii::app()->db->createCommand()
                ->select()
                ->from('likes')
                ->where('user_id=:user_id and api_id=:api_id and type=:type', $this->params)
                ->queryRow();

        if (!$row) {
            $this->_addRow();
            $status = 1;
        } else {
            $status = $this->_updateRow($row);
        }

        return $status;
    }

    private function _addRow()
    {
        Yii::app()->db->createCommand()
                ->insert('likes', array(
                    'user_id' => $this->params[':user_id'],
                    'api_id' => $this->params[':api_id'],
                    'type' => $this->params[':type'],
        ));
    }

    private function _updateRow($row)
    {
        $status = $row['status'] ? 0 : 1;

        Yii::app()->db->createCommand()
                ->update('likes', array(
                    'status' => $status,
                        ), 'id=:id', array(':id' => $row['id']));

        return $status;
    }

}