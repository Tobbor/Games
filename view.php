<?php

namespace view;

function outputEvent($a)
{
	echo $a;


}

function outputStats()
{
	echo "<h4>HP " . $_SESSION['herohp'] . "</br>";
	echo "XP " . $_SESSION['heroxp'] . "</h4>";

}

function outputStyle()
{
echo "
	<style>
	body
	{
	   width: 672px;
	   font-family: courier;
	   font-size: 32px;
       margin: 0px auto;
       text-align: center;
	}
	.H
	{
		width: 32px;
        height: 32px;
        float: left;
		background-image: url('images/character.png');
	}
	.G
	{
		width: 32px;
        height: 32px;
        float: left;
		background-image: url('images/grass.png');
	}
	.F
	{
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('images/trees_1.png');
	}
	.W
	{
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('images/big_lake_1.png');
	}
	.M
	{
		width: 32px;
        height: 32px;
        float: left;
        background-image: url('images/mountain_1.png');
	}
	</style>
	";
}

function outputTitle()
{
	echo "<h5>Turn Based Game<br/><small>Part 6 : Alternate Views</small><br/></h5>";
}


function outputGameWorld()
{
	$space = "&nbsp;";
	for($y = 0; $y < HEIGHT; $y++)
	{
		for($x = 0; $x < WIDTH; $x++)
		{
			if($x == $_SESSION['herox'] && $y == $_SESSION['heroy'])
			{
				if(\model\playerAlive())
					echo "<div class=H></div>";
				else
				    echo "<div class=H></div>";
			}
			else
			{
				//echo $space;

				$map = $_SESSION['map'][$y][$x];
				if($map == " ")
				{
					echo "<div class=G></div>";
				}
				else
				{
					echo "<div class=$map></div>";
				}
			}
		}
		echo "<br/>\n";
	}
}


function outputUserInterface()
{
	if(\model\playerAlive() == true) {
	}


}

function outputObituary()
{
	if (\model\playerAlive() == false) {
		echo "You are now dead</br></br>";
		echo "<a href='?reset'>reset</a></br>";
	}
}


function outputView($eventText) {


echo "
<head>
<title>RPG GAME</title>
      <link rel='stylesheet' type='text/css' href='layout.css' />

</head>

<body>
<div id='bg'>
           <div id='event'>";
             echo $eventText."
           </div>
  <div id='text'>
 "; echo outputStyle() . outputStats()  .  outputObituary()."
 </div>

 <div id='dead'>";
 echo outputObituary()."
 </div>

 <div id='top'>";
 echo outputTitle()."
 </div>

   <div id='gameworld'>";
    echo outputGameWorld()."
    </div>


</div>

<div id='up_arrow'>
<a href='?dir=up'>
<img src='images/Up.png'>
</a>
</div>

<div id='down_arrow'>
<a href='?dir=down'>
<img src='images/Down.png'>
</a>
</div>

<div id='right_arrow'>
<a href='?dir=right'>
<img src='images/Right.png'>
</a>
</div>

<div id='left_arrow'>
<a href='?dir=left'>
<img src='images/Left.png'>
</a>
</div>

<div id='back'>
<a href='#'>
<img src='images/Back.png'>
</a>
</div>


</body>
";

}


?>
