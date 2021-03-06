<?php
namespace common\components;

use Yii;
use common\components\CONSTANT;
use yii\helpers\FileHelper;

class F {
	/*
	 * settings get from the table settings
	 * Usage: F::sg('site', 'name');
	 */
	static function sg($category, $key)
	{
		return Yii::app()->settings->get($category, $key);
	}

	static function getStatus2($value=NULL)
	{
		$data = array(
			CONSTANT::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
			CONSTANT::STATUS_INACTIVE => Yii::t('app', 'STATUS_INACTIVE'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function getStatus3($value=NULL)
	{
		$data = array(
			CONSTANT::STATUS_ACTIVE => Yii::t('app', 'CONSTANT_YES'),
			CONSTANT::STATUS_INACTIVE => Yii::t('app', 'STATUS_INACTIVE'),
			CONSTANT::STATUS_DELETED => Yii::t('app', 'STATUS_DELETED'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function getYesNo($value=NULL)
	{
		$data = array(
			CONSTANT::CONSTANT_YES => Yii::t('app', 'CONSTANT_YES'),
			CONSTANT::CONSTANT_NO => Yii::t('app', 'CONSTANT_NO'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function getPageType($value=NULL)
	{
		$data = array(
			CONSTANT::PAGE_TYPE_LIST => Yii::t('app', 'PAGE_TYPE_LIST'),
			CONSTANT::PAGE_TYPE_PAGE => Yii::t('app', 'PAGE_TYPE_PAGE'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function strpos_array($haystack, $needle)
	{
		if(!is_array($needle))
			$needle = array($needle);
		foreach($needle as $what)
		{
			if(($pos = strpos($haystack, $what))!==false)
				return $pos;
		}
		return false;
	}

    public static function getAllTemplates()
    {
        $arrayTpl = FileHelper::findFiles(dirname(Yii::$app->BasePath).'/frontend/themes/'.Yii::$app->params['template'].'/site',['fileTypes'=>['php']]);
        $arrTpl = ['page' => [], 'list' => [], 'show' =>[]];
        foreach($arrayTpl as $tpl)
        {
            $tplName = substr(pathinfo($tpl,PATHINFO_BASENAME), 0, strpos(pathinfo($tpl,PATHINFO_BASENAME), '.'));
            if(strpos($tplName, 'page') !== false)
                $arrTpl['page'][$tplName] = $tplName;
            elseif(strpos($tplName, 'list') !== false)
                $arrTpl['list'][$tplName] = $tplName;
            elseif(strpos($tplName, 'show') !== false)
                $arrTpl['show'][$tplName] = $tplName;
        }

        return $arrTpl;
    }

}