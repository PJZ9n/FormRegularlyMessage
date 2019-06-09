<?php
	
	namespace regularlymessage;
	
	use pocketmine\Server;
	use pocketmine\scheduler\Task;
	
	class SendTask extends Task {
		
		public function onRun(int $tick) {
			//Removed By hack code
			//$message = Settings::getMessages()[array_rand(Settings::getMessages())];
			
			$messages = Settings::getMessages();
			$message = $messages[array_rand($messages)];
			Server::getInstance()->broadcastMessage("§a[" . Settings::getPrefix() . "§r§a]§b" . $message);
		}
	}