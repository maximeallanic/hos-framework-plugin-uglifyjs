<?php
namespace Hos\Plugin\UglifyJS;

use Assetic\Filter\UglifyJs2Filter;
use Assetic\Asset\FileAsset;
use Hos\Option;


/**
  * @author Maxime Allanic maxime@allanic.me
  * @license GPL
  * @internal Created 2016-07-26 12:08:57
  */
class Events{

	public function generate($arguments) {
		if (!isset($arguments['source']))
			return false;
		$assetInterface = new FileAsset($arguments['source'], [], null, null, $arguments['global']);
		$uglifyFilter = new UglifyJs2Filter();
		$assetInterface->setContent($arguments['content']);
		$uglifyFilter->setBeautify(Option::isDev());
		$uglifyFilter->setCompress(!Option::isDev());
		$uglifyFilter->filterLoad($assetInterface);
		$uglifyFilter->filterDump($assetInterface);

		return $assetInterface->getContent();
	}
}
