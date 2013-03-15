<?php

/**
 * This is the model class for table "{{registration}}".
 *
 * The followings are the available columns in table '{{registration}}':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property integer $active
 */
class Registration extends CActiveRecord
{
    public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Registration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{registration}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, name', 'required'),
                        array('login', 'email'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>100),
			array('password', 'length', 'max'=>50),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
                        array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'registration'),
			array('id, login, password, name, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'mail',
			'password' => 'Пароль',
			'name' => 'Ім"я',
			'active' => 'Активний',
                        'verifyCode' => 'Код з малюнку',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
            if($this->isNewRecord)
                $this->role=1;
                $this->date=time();
            
            $this->password= md5('es2pr1mo'.$this->password);
            return parent::beforeSave();
        }
}