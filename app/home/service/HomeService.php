<?php

namespace app\home\service;

use app\common\helper\Image;
use app\model\HomeModel;
use think\facade\Cache;
use think\facade\Lang;

/**
 * @desc    首页配置服务层
 * @author  BabyBuffary
 * @date    2020-08-31
 */
class HomeService
{
	public static function getConfig ()
	{
		$config = json_decode(Cache::get('index_config', null), true);

		if (null == $config) {
			// 从数据库中获取
			$config = HomeModel::where('id', 1)->find()->toArray();
			Cache::set('index_config', json_encode($config));
		}

		$lang = Lang::getLangSet();
		if ($lang == 'en-us') {
			return [
				'title'         => $config['title_en'],
				'company'       => $config['company_en'],
				'brief'         => $config['brief_en'],
				'brief_image'   => Image::make($config['brief_image']),
				'logos'         => Image::make($config['logos']),
				'num_award'     => $config['num_award'],
				'num_company'   => $config['num_company'],
				'num_turnover'  => $config['num_turnover'],
				'num_employees' => $config['num_employees'],
				'content'       => $config['content_en'],
			];
		}

		return [
			'title'         => $config['title_cn'],
			'company'       => $config['company_cn'],
			'brief'         => $config['brief_cn'],
			'brief_image'   => Image::make($config['brief_image']),
			'logos'         => Image::make($config['logos']),
			'num_award'     => $config['num_award'],
			'num_company'   => $config['num_company'],
			'num_turnover'  => $config['num_turnover'],
			'num_employees' => $config['num_employees'],
			'content'       => $config['content_cn'],
		];
	}
}