<?php
	
	namespace regularlymessage;
	
	use pocketmine\form\Form;
	use pocketmine\Player;
	
	class AddMessageForm implements Form {
		
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
			if ($data[0] === "") {
				$player->sendForm($this);
				return;
			}
			Settings::addMessage($data[0]);
			$player->sendMessage("メッセージ§l§c\"§f" . $data[0] . "§l§c\"§rを追加しました！");
		}
		
		public function jsonSerialize(): array {
			return [
				"type" => "custom_form",
				"title" => "ReguarlyMessage メッセージの追加",
				"content" => [
					[
						"type" => "input",
						"text" => "メッセージ",
					],
				],
			];
		}
		
	}