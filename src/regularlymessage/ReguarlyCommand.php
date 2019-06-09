<?php
	
	namespace regularlymessage;
	
	use pocketmine\command\Command;
	use pocketmine\command\CommandSender;
	use pocketmine\Player;
	
	class ReguarlyCommand extends Command {
		
		public function __construct() {
			parent::__construct("reguarly", "ReguaelyMessageの設定フォームを開く", "", ["reg"]);
			$this->setPermission("ReguarlyMessage.Settings.Change");
		}
		
		public function execute(CommandSender $sender, string $commandLabel, array $args): void {
			if (!$this->testPermission($sender)) {
				//not permission
				return;
			}
			if (!$sender instanceof Player) {
				$sender->sendMessage("ゲーム内で実行してください。");
				return;
			} else {
				$player = $sender;
				unset($sender);
			}
			$player->sendForm(new SettingMainForm());
			
		}
		
	}