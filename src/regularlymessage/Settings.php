<?php
	
	namespace regularlymessage;
	
	class Settings {
		
		/** @var string[] メッセージ一覧 */
		private static $messages = [];
		
		/** @var string プレフィックス */
		private static $prefix = "";
		
		/** @var int 繰り返し間隔 */
		private static $repeat_time = 0;
		
		/**
		 * メッセージ一覧を取得
		 *
		 * @return array
		 */
		public static function getMessages(): array {
			return self::$messages;
		}
		
		/**
		 * プレフィックスを取得
		 *
		 * @return string
		 */
		public static function getPrefix(): string {
			return self::$prefix;
		}
		
		/**
		 * 繰り返し間隔を取得
		 *
		 * @return int
		 */
		public static function getRepeatTime(): int {
			return self::$repeat_time;
		}
		
		/**
		 * メッセージ一覧を設定
		 *
		 * @param string[] $messages
		 */
		public static function setMessages(array $messages): void {
			self::$messages = $messages;
		}
		
		/**
		 * メッセージ一覧に追加
		 *
		 * @param string $message
		 */
		public static function addMessage(string $message): void {
			self::$messages[] = $message;
		}
		
		/**
		 * メッセージを一覧から削除
		 *
		 * @param int $message_number
		 */
		public static function delMessage(int $message_number): void {
			unset(self::$messages[$message_number]);
			self::$messages = array_values(self::$messages);
		}
		
		/**
		 * メッセージを編集
		 *
		 * @param int $message_number
		 * @param string $message
		 */
		public static function editMessage(int $message_number, string $message): void {
			self::$messages[$message_number] = $message;
		}
		
		/**
		 * プレフィックスを設定
		 *
		 * @param string $prefix
		 */
		public static function setPrefix(string $prefix): void {
			self::$prefix = $prefix;
		}
		
		/**
		 * 繰り返し間隔を設定
		 *
		 * @param int $repeat_time
		 */
		public static function setRepeatTime(int $repeat_time): void {
			self::$repeat_time = $repeat_time;
		}
		
	}