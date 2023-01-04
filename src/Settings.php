<?php
/**
 * Tracy plugin for Craft CMS 4
 *
 * @link      https://www.github.com/siteone/craft-tracy
 * @copyright Copyright (c) 2023 SiteOne, s.r.o.
 */

namespace SiteOne\Craft\Plugins\Tracy;

use craft\base\Model;

/**
 * @author  SiteOne, s.r.o.
 * @package Tracy
 * @since   1.0.0
 */
class Settings extends Model
{

	/**
	 * Maximum string length
	 * @var int
	 */
	public int $maxLength = 150;

	/**
	 * How deep will list
	 * @var int
	 */
	public int $maxDepth = 4;

	/**
	 * Hide values of these keys
	 * @var string[]
	 */
	public array $keysToHide = [];

	/**
	 * Visual theme (light, dark)
	 * @var string
	 */
	public string $dumpTheme = 'light';

	/**
	 * Display the location where dump() was called?
	 * @var bool
	 */
	public bool $showLocation = false;

	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			[['maxLength', 'maxDepth', 'keysToHide', 'dumpTheme', 'showLocation'], 'required'],
		];
	}

}
