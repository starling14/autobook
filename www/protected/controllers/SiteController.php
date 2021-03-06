<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionRegistration()
	{
		$model=new Registration;
                $model->scenario = 'registration';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Registration']))
		{ 
			$model->attributes=$_POST['Registration'];
			if($model->save()){
                            Yii::app()->user->setFlash('registration','Ви успішно зареєструвалися!');
                        }
				//$this->redirect(array('view','id'=>$model->id));
                        
                        //Відсилає підтвердження реєстрації на mail
                        $findLogin= Registration::model()->findByAttributes(array('email'=>$model->email));
                        //echo $findLogin->name;
                        
                        $email = Yii::app()->email;
                        $email->to = $findLogin->email;
                        $email->subject = 'Confirm your registration';
                        $email->message = 'To confirm you ragistration click here <a href="http://autobook/index.php/site/confirm/'.$findLogin->id.'?password='.$findLogin->password.'">confirmation</a>';
                        $email->send();
		}

		$this->render('registration',array(
			'model'=>$model,
		));
	}
        ///Ф-ї для підтвердження реєстрації
        public function loadModel($id)
	{
		$model=Registration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function actionConfirm($id, $password)
	{       
		$model=$this->loadModel($id);

                if($model->password==$password){
                    $confirmUser= Registration::model()->updateByPk($id, array('active'=>'1'));
                    $message = 'Вітаємо, ви підтвердили реєстрацію!';
                }else{
                    $message = 'Вам не вдалося підтвердити реєстрацію!';
                }
                
		$this->render('confirm',array(
			'message'=>$message,
		));
	}
}