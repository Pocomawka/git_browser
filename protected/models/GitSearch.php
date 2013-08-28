<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class GitSearch extends CFormModel
{

    private $_apiUrl = 'https://api.github.com/';
    private $_uri;

    public function getRepo($owner, $repo)
    {
        if (!isset($owner) && !isset($repo)) {
            $owner = 'yiisoft';
            $repo = 'yii';
        }
        $this->_setRequestUri(array('repos', $owner, $repo));

        $res['repo'] = $this->_apiRequest();

        $res['repo']['like'] = $this->_getLikeStatus(array(
            ':api_id' => $res['repo']['id'],
            ':type' => 0
        ));

        $res['contributors'] = $this->getContributors();

        return $res;
    }

    public function getUser($user)
    {
        $this->_setRequestUri(array('users', $user));

        $user = $this->_apiRequest();

        $user['like'] = $this->_getLikeStatus(array(
            ':api_id' => $user['id'],
            ':type' => 1
        ));

        return $user;
    }

    public function searchRepos($query)
    {
        $this->_setRequestUri(array('search', 'repositories'), array('q' => $query, 'sort' => 'stars'));

        $repos = $this->_apiRequest();

        if (isset($repos)) {
            $repos['items'] = $this->_getResLikes($repos['items'], 0);
        }

        return $repos;
    }

    public function getContributors($owner = null, $repo = null, $limit = 7)
    {
        if (isset($owner) && isset($repo)) {
            $this->_setRequestUri(array('repos', $owner, $repo));
        }

        $this->_uri .= '/contributors';

        $contributors = array_slice($this->_apiRequest(), 0, $limit);

        return $this->_getResLikes($contributors, 1);
    }

    private function _apiRequest()
    {
        $data = json_decode(Yii::app()->curl->run($this->_apiUrl . $this->_uri)->getData(), true);

        return $data;
    }

    private function _setRequestUri(array $data, array $query = null)
    {
        $this->_uri = implode('/', $data);

        if (isset($query)) {
            $cnt = 0;

            foreach ($query as $key => $value) {

                if ($cnt) {
                    $this->_uri .= '&';
                } else {
                    $this->_uri .= '?';
                }
                $this->_uri .= $key . '=' . $value;

                $cnt++;
            }
        }
    }

    private function _getResLikes(array $res, $type)
    {
        foreach ($res as $key => $value) {
            $res[$key]['like'] = $this->_getLikeStatus(array(
                ':api_id' => $value['id'],
                ':type' => $type
            ));
        }

        return $res;
    }

    private function _getLikeStatus(array $fields)
    {
        if ($cookie = Yii::app()->request->cookies['user_id']) {

            $fields[':user_id'] = $cookie->value;

            $row = Yii::app()->db->createCommand()
                    ->select('status')
                    ->from('likes')
                    ->where('user_id=:user_id and api_id=:api_id and type=:type', $fields)
                    ->queryRow();

            if (!empty($row)) {
                return $row['status'];
            }
        }
    }

}