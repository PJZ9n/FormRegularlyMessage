<?php
	
	namespace regularlymessage;
	
	use pocketmine\plugin\PluginBase;
	use pocketmine\scheduler\TaskHandler;
	use pocketmine\utils\Config;
	
	class Main extends PluginBase {
		
		/** @var Main インスタンス */
		private static $instance = null;
		
		/** @var Config メイン設定ファイル(Reguarly.yml) */
		private $config = null;
		
		/** @var TaskHandler 送信タスク */
		private $sendTask = null;
		
		/**
		 * Mainインスタンスを取得
		 *
		 * @return Main
		 */
		public static function getInstance(): Main {
			return self::$instance;
		}
		
		public function onEnable(): void {
			self::$instance = $this;
			
			$this->getLogger()->info("§aこのプラグインはMITライセンスにより配布されています");
			
			$this->getServer()->getCommandMap()->register("reguarlymessage", new ReguarlyCommand());
			
			$this->config = new Config($this->getDataFolder() . "Regularly.yml", Config::YAML, [
				'RepeatSeconds' => 90,
				'Messages' => [
					'RegularlyMessageを使って頂きありがとうございます',
					'メッセージを変更するには、Regularly.ymlを編集した後に再起動するか、/regコマンドで変更してください。',
				],
				'Prefix' => '定期',
			]);
			
			Settings::setMessages($this->config->get("Messages"));
			Settings::setPrefix($this->config->get("Prefix"));
			Settings::setRepeatTime($this->config->get("RepeatSeconds"));
			
			$this->submitSendTask();
		}
		
		public function onDisable(): void {
			$this->config->set("Messages", Settings::getMessages());
			$this->config->set("Prefix", Settings::getPrefix());
			$this->config->set("RepeatSeconds", Settings::getRepeatTime());
			$this->config->save();
		}
		
		public function submitSendTask() {
			if ($this->sendTask instanceof TaskHandler) {
				$this->sendTask->cancel();
			}
			$sec = Settings::getRepeatTime();
			$sec = $sec * 20;
			
			$this->sendTask = $this->getScheduler()->scheduleRepeatingTask(new SendTask(), $sec);
		}
	}