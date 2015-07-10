<?php
class Dolumar_Effects_Boost_SabotageWizards extends Dolumar_Effects_Boost
{
	protected $sType = 'thievery';
	protected $iDuration = 86400;

	protected function getBonusFromLevel ()
	{
		switch ($this->getLevel ())
		{
			case 1:
			default:
				return 50;
			break;
			
			case 2:
				return 60;
			break;
			
			case 3:
				return 70;
			break;
			
			case 4:
				return 80;
			break;
			
			case 5:
				return 90;
			break;
		}
	}

	public function procEffectDifficulty ($difficulty, $effect) 
	{
		if ($effect->getEffectType () == 'magic')
		{
			$difficulty += ($difficulty / 100) * $this->getBonusFromLevel ();
		}
		
		return $difficulty;
	}
	
	public function getDescription ($data = array ())
	{
		return parent::getDescription
		(
			array
			(
				'penalty' => $this->getBonusFromLevel ()
			)
		);
	}
}
?>
