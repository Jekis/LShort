<?php

class LinkController extends Controller
{
    public $defaultAction = 'shorten';

    /**
     * Shortens url.
     */
    public function actionShorten()
    {
        $formModel      = new Link;
        $createdModel   = null;

        if (isset($_POST['Link'])) {
            $formModel->attributes = $_POST['Link'];

            // Ajax Form validation.
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'link-form') {
                echo CActiveForm::validate($formModel);
                Yii::app()->end();
            }

            // Regular form validation.
            if ($formModel->validate()) {
                // Look for existing link
                $createdModel = Link::model()->find('url=:url', array(':url' => $formModel->url));

                if ($createdModel) {
                    $formModel = new Link;
                } else {
                    // Save
                    if ($formModel->save()) {
                        $createdModel = $formModel;
                        $formModel = new Link;
                    }
                }
            }
        }

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial(
                '_shorten_url',
                array('link' => $createdModel),
                false,
                true
            );
        } else {
            $this->render(
                'shorten',
                array(
                    'formModel'     => $formModel,
                    'createdModel'  => $createdModel,
                )
            );
        }
    }

    /**
     * Redirect to url.
     *
     * @param string $code the ID of the model
     *
     * @throws CHttpException
     */
    public function actionOpen($code)
    {
        $id = Link::unShorten($code);

        if (!is_numeric($id)) {
            throw new CHttpException(404, 'Not found');
        }

        if ($model = Link::model()->findByPk($id)) {
            $this->redirect($model->url, true, 301);
        }

        throw new CHttpException(404, 'Not found');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }
}
