<?php
declare(strict_types=1);

namespace SiteOne\Craft\Plugins\Tracy\Bar;

use craft\web\User;
use Tracy\IBarPanel;

class UserPanel implements IBarPanel
{

	private User $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getTab(): ?string
	{
		$status = !$this->user->isGuest;

		ob_start();
		require __DIR__ . '/panels/UserPanel.tab.phtml';
		$tab = ob_get_contents();
		ob_end_clean();

		return $tab;
	}

	public function getPanel(): ?string
	{
		$user = $this->user;
		$identity = $user->getIdentity();

		ob_start();
		require __DIR__ . '/panels/UserPanel.panel.phtml';
		$panel = ob_get_contents();
		ob_end_clean();

		return $panel;
	}

}
