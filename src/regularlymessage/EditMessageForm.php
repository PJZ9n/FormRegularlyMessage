<?php
	
	namespace regularlymessage;
	
	use pocketmine\form\Form;
	use pocketmine\Player;
	
	class EditMessageForm implements Form {
		
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
			switch ($data) {
				case 0;
					//Edit Message
					$player->sendForm(new EditMessageTextForm($this->message_number));
					break;
				case 1:
					//Delete Message
					Settings::delMessage($this->message_number);
					$player->sendMessage("そのメッセージを削除しました！");
					break;
				default:
					//Cracking or bug
			}
		}
		
		public function jsonSerialize(): array {
			$select_message = Settings::getMessages()[$this->message_number];
			return [
				"type" => "form",
				"title" => "ReguarlyMessage メッセージの編集",
				"content" => "選択中メッセージ:\n{$select_message}",
				"buttons" => [
					[
						"text" => "メッセージを編集する",
						"image" => [
							"type" => "path",
							"data" => "textures/ui/book_edit_default",
						],
					],
					[
						"text" => "メッセージを削除する",
						"image" => [
							"type" => "path",
							"data" => "textures/ui/book_trash_default",
						],
					],
				],
			];
		}
		
	}