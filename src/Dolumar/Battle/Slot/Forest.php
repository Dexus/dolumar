<?php
class Dolumar_Battle_Slot_Forest extends Dolumar_Battle_Slot_Grass
{
	/**
	*	Return the effects that are affecting this area
	*/
	public function getEffects ()
	{
		return array (new Dolumar_Effects_Boost_BattleSlotForest ());
	}
}
?>