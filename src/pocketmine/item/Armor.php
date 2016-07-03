<?php

namespace pocketmine\item;

abstract class Armor extends Item{

	public function getMaxStackSize(){
		return 1;
	}

	public function isArmor(){
		return true;
	}

	/**
	 *
	 * @param Item $object
	 * @param int $cost
	 *
	 * @return bool
	 */
	public function useOn($object, int $cost = 1){
		if($this->isUnbreakable()){
			return true;
		}
		$unbreakings = [
			0 => 100,
			1 => 80,
			2 => 73,
			3 => 70
		];
		#$unbreakingl = $this->getEnchantmentLevel(Enchantment::TYPE_MINING_DURABILITY);
		#if(mt_rand(1, 100) > $unbreakings[$unbreakingl]){
			#return true;
		#}
		$this->setDamage($this->getDamage() + $cost);
		if($this->getDamage() >= $this->getMaxDurability()){
			$this->setCount(0);
		}
		return true;
	}

	public function isUnbreakable(){
		$tag = $this->getNamedTagEntry("Unbreakable");
		return $tag !== null and $tag->getValue() > 0;
	}

	public function setCustomColor(Color $color){
		if(($hasTag = $this->hasCompoundTag())){
			$tag = $this->getNamedTag();
		}else{
			$tag = new CompoundTag("", []);
		}
		$tag->customColor = new IntTag("customColor", $color->getColorCode());
		$this->setCompoundTag($tag);
	}

	public function getCustomColor(){
		if(!$this->hasCompoundTag()) return null;
		$tag = $this->getNamedTag();
		if(isset($tag->customColor)){
			return $tag["customColor"];
		}
		return null;
	}

	public function clearCustomColor(){
		if(!$this->hasCompoundTag()) return;
		$tag = $this->getNamedTag();
		if(isset($tag->customColor)){
			unset($tag->customColor);
		}
		$this->setCompoundTag($tag);
	}

	public function getArmorTier(){
		return false;
	}

	public function getArmorType(){
		return false;
	}

	public function getMaxDurability(){
		return false;
	}

	public function getArmorValue(){
		return false;
	}

	public function isHelmet(){
		return false;
	}

	public function isChestplate(){
		return false;
	}

	public function isLeggings(){
		return false;
	}

	public function isBoots(){
		return false;
	}
}