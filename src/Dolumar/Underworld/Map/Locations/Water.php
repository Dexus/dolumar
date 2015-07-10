<?php
class Dolumar_Underworld_Map_Locations_Water
	extends Dolumar_Underworld_Map_Locations_Location
{
	public static function getMultipleImages ($fn, $random)
	{
		static $multiples;
		
		if (!isset ($multiples))
		{
			$multiples = array
			(
				'water_11111111' => array ('water_11111111', 'water_11111111b', 'water_11111111c', 'water_11111111d', 'water_11111111e'),
			);
		}

		if (isset ($multiples[$fn]))
		{
			$key = $random % count ($multiples[$fn]);
			return $multiples[$fn][$key];
		}
		else
		{
			return $fn;
		}
	}

	public function getTile (Dolumar_Underworld_Map_BackgroundManager $map)
	{
		$l = $map->getSingleLocation ($this->x () - 1, $this->y () + 0) instanceof Dolumar_Underworld_Map_Locations_Water;
		$b = $map->getSingleLocation ($this->x () + 0, $this->y () + 1) instanceof Dolumar_Underworld_Map_Locations_Water;
		$r = $map->getSingleLocation ($this->x () + 1, $this->y () + 0) instanceof Dolumar_Underworld_Map_Locations_Water;
		$o = $map->getSingleLocation ($this->x () + 0, $this->y () - 1) instanceof Dolumar_Underworld_Map_Locations_Water;

		$zLinks = $l ? '1' : '0';
		$zBoven = $b ? '1' : '0';
		$zRechts = $r ? '1' : '0';
		$zOnder = $o ? '1' : '0';

		$lb = $map->getSingleLocation ($this->x() - 1, $this->y() + 1);
		$rb = $map->getSingleLocation ($this->x() + 1, $this->y() + 1);
		$ro = $map->getSingleLocation ($this->x() + 1, $this->y() - 1);
		$lo = $map->getSingleLocation ($this->x() - 1, $this->y() - 1);

		$hLinksBoven = !($l && $b && $lb instanceof Dolumar_Underworld_Map_Locations_Water) ? '0' : '1';
		$hRechtsBoven = !($r && $b && $rb instanceof Dolumar_Underworld_Map_Locations_Water) ? '0' : '1';
		$hRechtsOnder = !($r && $o && $ro instanceof Dolumar_Underworld_Map_Locations_Water) ? '0' : '1';
		$hLinksOnder = !($l && $o && $lo instanceof Dolumar_Underworld_Map_Locations_Water) ? '0' : '1';

		// De zijden
		$zijden = $zLinks . $zBoven . $zRechts . $zOnder;

		// De hoeken
		$hoeken = $hLinksOnder . $hLinksBoven . $hRechtsBoven . $hRechtsOnder;

		$bits = $zijden . $hoeken;

		$bits  = $hLinksBoven . $zBoven . $hRechtsBoven;
		$bits .= $zLinks . $zRechts;
		$bits .= $hLinksOnder . $zOnder . $hRechtsOnder;

		$prefix = STATIC_URL . 'images/underworld/lava-tiles/';
		$posfix = '.png';

		$img = self::getMultipleImages ('' . $bits, $this->getRandomNumber (100));
	
		return new Neuron_GameServer_Map_Display_Sprite ($prefix . $img . $posfix);
	}
	
	public function isPassable ()
	{
		return false;
	}
}
?>
