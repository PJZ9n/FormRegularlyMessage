<?php
	
	namespace regularlymessage;
	
	use pocketmine\form\Form;
	use pocketmine\Player;
	
	class EditMessagesForm implements Form {
		
		public function handleResponse(Player $player, $data): void {
			if (!$player->hasPermission("ReguarlyMessage.Settings.Change")) {
				//Cracking or bug
				return;
			}
			if (is_null($data)) {
				//Push close
				return;
			}
			//TODO: 入力値の検証処理が必要
			$player->sendForm(new EditMessageForm($data));
		}
		
		public function jsonSerialize(): array {
			$buttons = [];
			foreach (Settings::getMessages() as $message) {
				$buttons[] = [
					"text" => mb_strimwidth($message, 0, 34, "..."),
					"image" => [
						"type" => "path",
						"data" => "textures/items/book_writable",
					],
				];
			}
			return [
				"type" => "form",
				"title" => "ReguarlyMessage メッセージの編集",
				"content" => "Please select messsage!",
				"buttons" => $buttons,
			];
		}
		
	}