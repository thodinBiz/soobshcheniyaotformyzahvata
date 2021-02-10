<?php
/**
 * Created by PhpStorm.
 * User: Thodin
 * Date: 24.08.2020
 * Time: 1:53
 */

namespace Thodin\SoobshcheniyaOtFormyZahvata\Classes;

use Thodin\SoobshcheniyaOtFormyZahvata\Models\Messages;
use Vdomah\Telegram\Classes\TelegramApi;

class Messager
{

    const TELEGRAM_CHAT_ID = '-1001408236650';
    const BOT_AUTH = '1274003124:AAEe9rqhaL0Oan-MiBMvA41wN--IXXTQQOM';

    public static $_instance;

    private $cookieNames = [
        'utm_campaign',
        'utm_source',
        'utm_medium',
        'utm_term',
        'utm_content',
    ];

    /**
     * @param Messages $message
     *
     * @throws \Exception
     */
    public function sendMessage($message)
    {
        $text = $this->buildText($message);

        $this->sendNotifyToTelegram($text);
        //TelegramApi::instance()->sendMessage(['chat_id' => self::TELEGRAM_CHAT_ID, 'text' => $text]);
    }

    /**
     * @return array
     */
    protected function getUTMCookies()
    {
        $matchedCookies = [];

        foreach ($this->cookieNames as $cName)
        {
            $tmp = \Cookie::get($cName);

            if (!empty($tmp))
            {
                $matchedCookies[$cName] = $tmp;
            }
        }

        return $matchedCookies;
    }

    /**
     * @return Messager
     */
    public static function instance()
    {
        if (!self::$_instance)
        {
            self::$_instance = new Messager();
        }

        return self::$_instance;

    }

    /**
     * @param Messages $message
     *
     * @return string
     */
    private function buildText(Messages $message)
    {
        $text = "
Имя: {$message->name}
Телефон: +{$message->phone}
Почта: {$message->email}
Сообщение: {$message->message}


Форма: {$message->form}
{$message->url}

UTM Метки
";


        $matchedCookies = $this->getUTMCookies();

        foreach ($matchedCookies as $k => $v)
        {
            $text .= $k . "\t" . $v . "\n";
        }

        return $text;
    }

    /**
     * @param string $message
     *
     * @return bool|string
     */
    public function sendNotifyToTelegram($message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.telegram.org/bot' . self::BOT_AUTH . '/sendMessage',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT        => 3,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS     => json_encode([
                'chat_id' => self::TELEGRAM_CHAT_ID,
                'text'    => $message,
            ]),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Connection: Close',
            ],
        ]);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}
