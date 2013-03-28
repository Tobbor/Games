function outputGameWorld()
{
	$space = "&#160";

	for($y = 0; $y < HEIGHT; $y++)
	{
		for($x = 0; $x < WIDTH; $x++)
		{
			if($y == 0 || $y == HEIGHT - 1 || $x == 0 || $x == WIDTH - 1)
			{
				echo "X";
			}
			else
			{
				if($x == $_SESSION['herox'] && $y == $_SESSION['heroy'])

				{
					if(playerAlive())
					echo "&#x25B2";
					else 
					echo "¤";
				}
				else
				{
					echo $space;
				}
			}
		}
		echo "<br/>";
	}
}