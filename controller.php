<?php

namespace controller;

function checkForInput()
{
	if(isset($_GET['reset']))
	{
		\model\resetSessionData();
	}

	if(isset($_GET['dir']))
	{
		switch($_GET['dir'])
		{
			case "up":
			{
				if ($_SESSION['heroy'])
				{
					\model\moveHero(0, -1);

				if(!\model\heroOnPassableTerrain())
				{
					\model\moveHero(0, 1);
					return FALSE;

				}
				return TRUE;
				}
			}
			break;

			case "down":
			{
				if ($_SESSION['heroy'])
				{
					\model\moveHero(0, 1);

				if(!\model\heroOnPassableTerrain())
				{
                                        \model\moveHero(0, -1);
					return FALSE;
				}
				return TRUE;
				}
			}
			break;

			case "left":
			{
				if($_SESSION['herox'])
				{
                                        \model\moveHero(-1, 0);

				if(!\model\heroOnPassableTerrain())
				{
					\model\moveHero(1, 0);
					return FALSE;
				}
				return TRUE;
				}
			}
			break;

			case "right":
			{
				if($_SESSION['herox'])
				{
                                        \model\moveHero(1, 0);

				if(!\model\heroOnPassableTerrain())
				{
					\model\moveHero(-1, 0);
					return FALSE;
				}
				return TRUE;
				}
			}
			break;
		}
	}

	return false;
}



?>                                                                                             