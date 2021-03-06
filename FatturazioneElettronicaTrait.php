<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-traits
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-traits
 * @version 1.2.3
 */

namespace cinghie\traits;

use Yii;
use kartik\widgets\ActiveForm;
use yii\base\InvalidConfigException;
use yii\base\Model;

/**
 * Trait FatturazioneElettronicaTrait
 *
 * @property string $pec
 * @property string $sdi
 */
trait FatturazioneElettronicaTrait
{
	/**
	 * @inheritdoc
	 */
	public static function rules()
	{
		return  [
			[['sdi'], 'string', 'max' => 7],
			[['pec'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function attributeLabels()
	{
		return [
			'pec' => Yii::t('traits', 'PEC'),
			'sdi' => Yii::t('traits', 'SDI'),
		];
	}

	/**
	 * Get PEC Widget
	 *
	 * @param ActiveForm $form
	 *
	 * @return mixed
	 * @throws InvalidConfigException
	 */
	public function getPecWidget($form)
	{
		/** @var Model $this */
		return $form->field($this, 'pec', [
			'addon' => [
				'prepend' => [
					'content'=>'<i class="fa fa-at"></i>'
				]
			]
		])->textInput(['maxlength' => true]);
	}

	/**
	 * Get SDI Widget
	 *
	 * @param ActiveForm $form
	 *
	 * @return mixed
	 * @throws InvalidConfigException
	 */
	public function getSdiWidget($form)
	{
		/** @var Model $this */
		return $form->field($this, 'sdi')->textInput(['maxlength' => true]);
	}
}
