<?php
/**
 * Tracy plugin for Craft CMS 4
 *
 * @link      https://www.github.com/siteone/craft-tracy
 * @copyright Copyright (c) 2023 SiteOne, s.r.o.
 */

namespace SiteOne\Craft\Plugins\Tracy;

use Tracy\Debugger;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author  SiteOne, s.r.o.
 * @package Tracy
 * @since   1.0.0
 */
class TwigExtension extends AbstractExtension
{

	/**
	 * @inheritdoc
	 */
	public function getName()
	{
		return 'Tracy';
	}

	/**
	 * @inheritdoc
	 */
	public function getFunctions()
	{
		return [
			new TwigFunction('dump', [$this, 'dump']),
			new TwigFunction('dumpe', [$this, 'dumpe']),
			new TwigFunction('bdump', [$this, 'bdump']),
			new TwigFunction('d', [$this, 'dump']),
			new TwigFunction('dd', [$this, 'dumpe']),
			new TwigFunction('bd', [$this, 'bdump']),
		];
	}

	/**
	 * Tracy\Debugger::dump()
	 * @tracySkipLocation
	 */
	function dump()
	{
		array_map([Debugger::class, 'dump'], func_get_args());
	}

	/**
	 * Tracy\Debugger::dump() & exit
	 * @tracySkipLocation
	 */
	function dumpe()
	{
		array_map([Debugger::class, 'dump'], func_get_args());
		if (!Debugger::$productionMode) {
			exit;
		}
	}

	/**
	 * Tracy\Debugger::barDump()
	 * @tracySkipLocation
	 */
	function bdump()
	{
		Debugger::barDump(...func_get_args());
	}

}
