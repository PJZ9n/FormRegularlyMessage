<?php
	
	namespace regularlymessage;
	
	use pocketmine\form\Form;
	use pocketmine\Player;
	
	class EditRepeatTimeForm implements Form {
		
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
			//TODO: 入力値のさらに詳細な検証処理が必要
			if (!is_numeric($data[0]) || $data[0] <= 0) {
				$player->sendForm($this);
				return;
			}
			Settings::setRepeatTime($data[0]);
			Main::getInstance()->submitSendTask();
			$player->sendMessage("繰り返し間隔を§l§c\"§f" . $data[0] . "§l§c\"§rに設定しました！");
		}
		
		public function jsonSerialize(): array {
			return [
				"type" => "custom_form",
				"title" => "ReguarlyMessage 繰り返し間隔の編集",
				"content" => [
					[
						"type" => "input",
						"text" => "繰り返し間隔(秒)",
						"default" => strval(Settings::getRepeatTime()),
					],
				],
			];
		}
		
	}