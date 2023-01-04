<?php
/**
 * Tracy plugin for Craft CMS 4
 *
 * @link      https://www.github.com/siteone/craft-tracy
 * @copyright Copyright (c) 2023 SiteOne, s.r.o.
 */

namespace SiteOne\Craft\Plugins\Tracy;

use Craft;
use craft\base\Plugin;

/**
 * @author  SiteOne, s.r.o.
 * @package Tracy
 * @since   1.0.0
 */
class Tracy extends Plugin
{

	/**
	 * @var Tracy
	 */
	public static $plugin;
	public bool $hasCpSettings = false;
	public bool $hasCpSection = false;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		self::$plugin = $this;

		$isDebug = Craft::$app->view->twig->isDebug();

		Craft::$app->view->registerTwigExtension(new TwigExtension());

		\Tracy\Debugger::$maxLength = $this->getSettings()->maxLength;
		\Tracy\Debugger::$maxDepth = $this->getSettings()->maxDepth;
		\Tracy\Debugger::$keysToHide = $this->getSettings()->keysToHide;
		\Tracy\Debugger::$dumpTheme = $this->getSettings()->dumpTheme;
		\Tracy\Debugger::$showLocation = $this->getSettings()->showLocation;
		\Tracy\Debugger::enable($isDebug ? \Tracy\Debugger::DEVELOPMENT : \Tracy\Debugger::PRODUCTION);

		Craft::info(
			Craft::t(
				'tracy',
				'{name} plugin loaded',
				['name' => $this->name]
			),
			__METHOD__
		);
	}

	/**
	 * @return Craft\base\Model|null
	 */
	protected function createSettingsModel(): ?craft\base\Model
	{
		return new Settings();
	}

}
