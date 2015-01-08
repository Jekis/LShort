<?php

/**
 * This is the model class for table "link".
 *
 * The followings are the available columns in table 'link':
 * @property string $id
 * @property string $url
 */
class Link extends CActiveRecord
{
    public static $codeSet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    public $shortCode;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'link';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('url', 'required'),
            array('url', 'url'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'url' => 'Long URL',
        );
    }

    /**
     * @return mixed
     */
    public function getShortCode()
    {
        if ($this->id && null === $this->shortCode) {
            $this->shortCode = self::shorten($this->id);
        }
        return $this->shortCode;
    }

    public static function shorten($number) {
        $set = self::$codeSet;
        $base = strlen($set);
        $converted = "";
        while ($number > 0) {
            $converted = substr($set, ($number % $base), 1) . $converted;
            $number = floor($number/$base);
        }
        return $converted;
    }


    public static function unShorten($converted) {
        $set = self::$codeSet;
        $base = strlen($set);
        $number = 0;
        for ($i = strlen($converted); $i; $i--) {
            $number += strpos($set, substr($converted, (-1 * ( $i - strlen($converted) )),1))
                * pow($base,$i-1);
        }
        return $number;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->getShortCode();
    }

    protected function afterSave()
    {
        parent::afterSave();
        $this->getShortCode();
    }
}
