<?php

class SiteController extends Controller
{

    public function actionIndex()
    {
        if (Yii::app()->request->getParam('owner')) {
            $step = 'Project';
        } else {
            $step = 'Main';
        }
        $this->breadcrumbs = array(
            $step
        );
        $git = new GitSearch;

        $this->render('index', $git->getRepo(Yii::app()->request->getParam('owner'), Yii::app()->request->getParam('repo')));
    }

    public function actionUsers()
    {
        $this->breadcrumbs = array(
            'User'
        );
        $git = new GitSearch;

        $this->render('user', array('user' => $git->getUser(Yii::app()->request->getParam('user'))));
    }

    public function actionSearch()
    {
        $this->breadcrumbs = array(
            'Search'
        );
        $git = new GitSearch;

        $this->render('search', array('repos' => $git->searchRepos(Yii::app()->request->getQuery('q'))));
    }

    public function actionLike()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $like = new Like;

            echo CHtml::encode($like->setLike(Yii::app()->request->getParam('id'), Yii::app()->request->getParam('type')));
            Yii::app()->end();
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}