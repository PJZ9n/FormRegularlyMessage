<?php
	
	namespace regularlymessage;
	
	use pocketmine\form\Form;
	use pocketmine\Player;
	
	class EditPrefixForm implements Form {
		
		public function handleResponse(Player $player, $data): void {
			if (!$player->hasPermission("ReguarlyMessage.Settings.Change")) {
				//Cracking or bug
				return;
			}
			if (is_null($data)) {
				//Push close
				return;
			}
			if (!isset($data[0])) {
				//Cracking or bug
				return;
			}
			//TODO: 入力値の検証処理が必要
			Settings::setPrefix($data[0]);
			$player->sendMessage("プレフィックスを§l§c\"§f" . $data[0] . "§l§c\"§rに設定しました！");
		}
		
		public function jsonSerialize(): array {
			return [
				"type" => "custom_form",
				"title" => "ReguarlyMessage プレフィックスの編集",
				"content" => [
					[
						"type" => "input",
						"text" => "プレフィックス",
						"default" => Settings::getPrefix(),
					],
				],
			];
		}
		
	}