<?php

require_once('constants.php');
require_once('model.php');
require_once('controller.php');
require_once('view.php');
//require_once(prettyview.php);


\model\startup();
if(\controller\checkForInput())
{
 $eventText = \model\doEvent();
}
else
{
 $eventText = null;
}

\view\outputView($eventText);

if($eventText)
{
 \view\outputEvent($eventText);
}


if(!\model\playerAlive())
{
 \view\outputObituary();
}

/*
entry point
\model\startup();
if(\controller\checkForInput())
{
	$eventText = \model\doEvent();
}
\view\outputView($eventText);
*/

?>