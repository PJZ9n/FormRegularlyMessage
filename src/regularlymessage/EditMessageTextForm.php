<?php
	
	namespace regularlymessage;
	
	use pocketmine\form\Form;
	use pocketmine\Player;
	
	class EditMessageTextForm implements Form {
		
		/** @var int メッセージ番号 */
		private $message_number = 0;
		
		public function __construct(int $message_number) {
			$this->message_number = $message_number;
		}
		
		public function handleResponse(Player $player, $data): void {
			if (!$player->hasPermission("ReguarlyMessage.Settings.Change")) {
				//Cracking or bug
				return;
			}
			if (is_null($data)) {
				//Push close
				return;
			}
			if (!isset($data[1])) {
				//Cracking or bug
				return;
			}
			//TODO: 入力値の検証処理が必要
			if ($data[1] === "") {
				$player->sendForm($this);
				return;
			}
			Settings::editMessage($this->message_number, $data[1]);
			$player->sendMessage("メッセージを§l§c\"§f" . $data[1] . "§l§c\"§rに編集しました！");
		}
		
		public function jsonSerialize(): array {
			$select_message = Settings::getMessages()[$this->message_number];
			return [
				"type" => "custom_form",
				"title" => "ReguarlyMessage メッセージの編集",
				"content" => [
					[
						"type" => "label",
						"text" => "選択中メッセージ:\n{$select_message}",
					],
					[
						"type" => "input",
						"text" => "メッセージ",
						"default" => $select_message,
					],
				],
			];
		}
		
	}