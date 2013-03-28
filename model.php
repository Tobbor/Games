<?php

//05model.php

namespace model;
session_start();
init();

function startup()
{
	init();
}


function herox()
{
	return $_SESSION['herox'];
}

function heroy()
{
	return $_SESSION['heroy'];
}

function map($y,$x)
{
	return $_SESSION['map'];
}

function herohp()
{
	return  $_SESSION['herohp'];
}

function heroxp()
{
	return $_SESSION['heroxp'];
}



function init()
{

	if(!isset($_SESSION['herox']) ||
	!isset($_SESSION['heroy']) ||
	!isset($_SESSION['map']) ||
	!isset($_SESSION['herohp']) ||
	!isset($_SESSION['heroxp']))
	{
		resetSessionData();

	}

}

function doEvent()
{

$link = mysql_connect('localhost', 'c1bortob', '');
if (!$link)
{
    die('Not connected : ' . mysql_error());
}

if ($db_selected = mysql_select_db('c1bortob', $link))
{
     echo "Connected successfully";
    //här mysql_close($link);
}
else
{
    echo "Connected Failed";
}

$query = "SELECT pk FROM rpg_event";
$result = mysql_query($query);
$id_array;

while($row = mysql_fetch_array($result))
{
     $id_array[] = $row['pk'];
}

$random_array_key = array_rand($id_array);
$random_id = $id_array[$random_array_key];

$query = "SELECT * FROM rpg_event WHERE pk = '$random_id'";
$result = mysql_query($query);// Returns only ONE single row
$row = mysql_fetch_array($result);

$text = $row['text'];
$xp = $row['xp'];
$hp = $row['hp'];

mysql_close($link);

changeXP($xp);
changeHP($hp);
return $text;
}


/*function doEvent()
{
	switch(rand(1,7))	//you can alternatively use mt_rand() here...
	{
		default:
			return NULL;
			break;

		case 1:
			changeHP(+100);
			changeXP(0);
			return "Du åt en banan. +100 HP";
			break;

		case 2:
			changeHP(-50);
			changeXP(0);
			return "Du slogs med en Minotaur. -50 HP";
			break;

		case 3:
			changeHP(0);
			changeXP(+100);
			return "Du såg Sebbe liggandes i en buske. Du kastar en sten på han. +100 XP";
			break;

                case 4:
			changeHP(0);
			changeXP(+100);
			return "Du hittade ett par solglasögon.+100 XP";
			break;

                case 5:
			changeHP(-100);
			changeXP(0);
			return "Du snubbla på en stubbe och förlora ena ögat. -100 HP";
			break;

		case 6:

		      changeHP(0);
		      changeXP(100);
		      return "Du stöter på en trollkarl. +100 XP";
		      break;

                case 7:

                      changeHP(-500);
                      changeXP(0);
                      return "Du ramlar ner i en håla. -500 HP";
                      break;



	}
}*/

function changeHP($a)
{
	$_SESSION['herohp'] += $a;
}

function changeXP($a)
{
	$_SESSION['heroxp'] += $a;
}

function resetSessionData()
{
//	unset($_SESSION);

	$_SESSION['herox'] = START_X;
	$_SESSION['heroy'] = START_Y;

        $_SESSION['herohp'] = HERO_HP;
        $_SESSION['heroxp'] = 0;

	$_SESSION['map'][0] = topBottomMapRow();

	for($y = 1; $y < HEIGHT - 1; $y++)
	{
		$_SESSION['map'][$y] = randomMapRow();
	}
	$_SESSION['map'][HEIGHT - 1] = topBottomMapRow();

        heroOnPassableTerrain();

}

function heroOnPassableTerrain()
{
	$y = $_SESSION['heroy'];
	$x = $_SESSION['herox'];
	$notpassable = $_SESSION['map'][$y][$x];
	return $notpassable !="M" && $notpassable !="W";
}


function topBottomMapRow()
{
$return= "";
for ($y=0; $y < WIDTH; $y++)
    {
    	$return .= "M";
    }
    return $return;
}

function randomMapRow()
{
$return = "";
$grassChance = 50;
$forestChance = 80;
$waterChance = 95;
$mountainChance = 100;
for ($x = 0; $x < WIDTH; $x++)
{
	$rand = rand (1,100);
	if($x == 0 || $x == WIDTH-1)
	{
 	      $return .= "M";
	}
	else
	{
		if ($rand <= $grassChance)
		{
			$return .= " ";
		}
		elseif ($rand <= $forestChance)
		{
			$return .="F";
		}
		elseif ($rand <= $waterChance)
		{
			$return .="W";
		}
		elseif ($rand <= $mountainChance)
		{
		       $return .="M";
		}
 	}
}
return $return;
}


function moveHero($x, $y)
{
$_SESSION ['heroy'] += $y;
$_SESSION ['herox'] += $x;
}

function playerAlive()
{
	if ($_SESSION['herohp'] >= 0)
	{
	return true;
	}
	else
	{
	return false;
	}
}




?>