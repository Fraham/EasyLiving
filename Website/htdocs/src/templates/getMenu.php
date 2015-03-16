<?php
	$html = "";
	$prevType = 0;
	$opened = false;
	//type: 0 - singleItem; array(1 - itemWithSubmenu; array(2 - submenuItem
	//[type, link, name, icon]
	$menu = [
		[0, "dashboard", "Dashboard", "dashboard"],
		[0, "rooms", "Rooms", "sitemap"],
		[0, "sensors", "Sensors", "wifi"],
		[1, "#", "Events", "exclamation"],
		[2, "notifications", "History", "exclamation"],
		[2, "eventSettings", "Settings", "exclamation"],
		[0, "selection", "My Locations", "home",],
		[0, "settings", "Settigns", "edit"],
		[0, "icons.php", "Icons", "ban"],
	];

	foreach($menu as list($type, $link, $name, $icon))
	{
		if ($type != 2 and $opened)
		{
			$html .= "</ul></li>";
			$opened = false;
		}
		if ($type == 2 and !$opened)
		{
			$html .= "<ul class='nav nav-second-level dropdown-toggle'>";
			$opened = true;
		}
		if ($type == 1) $link = '#'; else $link = "../" . $link;
		$html .= "<li><a href='$link";
		$html .= "'style='color: #D80000'>";
		if ($type != 2)
			$html .= "<i class='fa fa-$icon fa-fw'></i>";
		$html .= " $name";
		if ($type == 1)
			$html .= "<span class='fa arrow'></span>";
		$html .= "</a>";
		if ($type != 1)
			$html .= "</li>";
	}
	if ($opened)
		$html .= "</ul></li>";
	echo $html;
?>
