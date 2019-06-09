<?php
	
	namespace regularlymessage;
	
	use pocketmine\form\Form;
	use pocketmine\Player;
	
	class SettingMainForm implements Form {
		
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
					//Edit Prefix
					$player->sendForm(new EditPrefixForm());
					break;
				case 1:
					//Create Message
					$player->sendForm(new AddMessageForm());
					break;
				case 2:
					//Edit Messages
					$player->sendForm(new EditMessagesForm());
					break;
				case 3:
					//Edit Time
					$player->sendForm(new EditRepeatTimeForm());
					break;
				default:
					//Cracking or bug
			}
		}
		
		public function jsonSerialize(): array {
			return [
				"type" => "form",
				"title" => "ReguarlyMessage 設定フォーム",
				"content" => "Push the button!",
				"buttons" => [
					[
						"text" => "プレフィックスの編集[現在: §l§c\"§f" . mb_strimwidth(Settings::getPrefix(), 0, 14, "...") . "§l§c\"§r§8]",
						"image" => [
							"type" => "path",
							"data" => "textures/ui/book_edit_default",
						],
					],
					[
						"text" => "メッセージの追加",
						"image" => [
							"type" => "path",
							"data" => "textures/ui/book_addtextpage_default",
						],
					],
					[
						"text" => "メッセージの編集[現在: §l§c" . count(Settings::getMessages()) . "§r§8個]",
						"image" => [
							"type" => "path",
							"data" => "textures/ui/book_edit_default",
						],
					],
					[
						"text" => "繰り返し間隔の編集[現在: §l§c" . Settings::getRepeatTime() . "§r§8秒]",
						"image" => [
							"type" => "path",
							"data" => "textures/items/clock_item",
						],
					],
				],
			];
		}
		
	}