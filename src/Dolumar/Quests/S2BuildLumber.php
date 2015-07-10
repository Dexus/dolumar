<?php
class Dolumar_Quests_S2BuildLumber extends Neuron_GameServer_Quest
{
	public function onStart (Neuron_GameServer_Player $player)
	{
		$player->guide->setAllRead ();
		
		$player->guide->addMessage ('s1complete', array (), 'guide', 'proud');
		$player->guide->addMessage ('s2buildlumber', array (), 'guide', 'neutral');
	}
	
	public function isFinished (Neuron_GameServer_Player $player)
	{
		$village = $player->getMainVillage ();
		
		// Check if we already have a farm
		return $village->buildings->hasBuilding 
		(
			Dolumar_Buildings_Building::getBuilding (12, $village->getRace ()), 
			true
		);
	}
	
	public function onComplete (Neuron_GameServer_Player $player)
	{
		$quest = new Dolumar_Quests_S2aBuildWarehouse ();
		$player->quests->addQuest ($quest);
	}
}
?>
