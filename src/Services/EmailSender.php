<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 23.10.2018
 * Time: 10:43
 */

namespace Services;

use Models\Users\User;

class EmailSender {
	public static function send( User $receiver, string $subject, string $templateName, array $templateVars = []) {
		extract($templateVars);

		ob_start();
		require __DIR__ . '/../../templates/mail/' . $templateName;
		$body = ob_get_contents();
		ob_end_clean();

		mail($receiver->getEmail(), $subject, $body);
	}
}