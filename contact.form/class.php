<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Mail\Event;

Loader::includeModule("iblock");
Loc::loadMessages(__FILE__);

class CAntipowContactForm extends CBitrixComponent
{
    private $arUtm = array();
    private $arUtmCookie;
    private $arUtmSession;
    public $message;

    public function utmGetSave()
    {
        $this->checkSession();
        $this->getSession();


        if ($this->getCookies())
        {
            $this->unserializeCookies();
        }


        if ($this->getSession())
        {
            $this->unserializeSession();
        }

        if (!empty($_GET))
        {
            $this->getUtmValues($_GET);
        }

        //записываем дату конверсии
        $this->setDateKonvers();

        //получаем рефер
        $this->setReferer();

        //записываем массив в сессию
        $this->saveSession();

        //записываем массив в куки на 10 лет
        $this->SaveToCookies();

        return $this->arUtm;
    }

    private function getUtmValues($arGet)
    {
        foreach ($arGet as $key => $value)
        {
            if (strpos($key, 'utm_') !== false)
            {
                $this->arUtm[$key] = htmlspecialchars($value);
            }
        }
    }

    private function unserializeCookies()
    {
        $arUtmCookie = $this->arUtmCookie;
        if (!empty($arUtmCookie))
            $arUtmCookie = unserialize($arUtmCookie);
        foreach ($arUtmCookie as $key => $utm)
        {
            if (!empty($utm))
            {
                $this->arUtm[$key] = $utm;
            }
        }
    }

    private function getCookies()
    {
        $result = false;
        $arCookies = Application::getInstance()->getContext()->getRequest()->getCookie("arUTM");
        if (!empty($arCookies))
        {
            $this->arUtmCookie = $arCookies;
            $result = true;
        }
        return $result;
    }

    private function SaveToCookies()
    {
        if (!empty($this->arUtm))
        {
            $cookie = new Cookie("arUTM", serialize($this->arUtm), time() + 60 * 60 * 24 * 365 * 10);
            $cookie->setDomain("prommashtest-lab.ru");
            Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
        }
    }

    private function checkSession()
    {
        if (!isset($_SESSION) && !session_id())
        {
            session_start();
        }
    }

    private function getSession()
    {
        $result = false;
        if (!empty($_SESSION["arUTM"]))
        {
            $this->arUtmSession = $_SESSION["arUTM"];
            $result = true;
        }
        return $result;
    }

    private function unserializeSession()
    {
        $arUtmSession = unserialize($this->arUtmSession);
        foreach ($arUtmSession as $key => $utm)
        {
            if (!empty($utm))
            {
                $this->arUtm[$key] = $utm;
            }
        }
    }

    private function saveSession()
    {
        $_SESSION["arUTM"] = $this->arUtm;
    }

    private function setDateKonvers()
    {
        if (empty($this->arUtm['konvers']))
        {
            $this->arUtm['konvers'] = date("d.m.Y H:i:s");
        }
    }

    private function setReferer()
    {
        if (!empty($_SERVER['HTTP_REFERER']) && empty($this->arUtm['referer']))
        {
            $this->arUtm['referer'] = $this->getReferer($_SERVER['HTTP_REFERER']);
        }
    }

    private function getReferer($referer = "")
    {
        $fromStr = "";
        $arReferer = parse_url($referer);
        if (!empty($arReferer['query']))
        {
            parse_str($arReferer['query'], $arQuery);
            $fromStr = $arQuery['from'];
        }


        if ($arReferer['host'] != "yabs.yandex.ru")
        {
            $refer_str = $arReferer['host'] . $arReferer['path'] . " " . $fromStr;
        }
        else
        {
            $refer_str = $arReferer['host'];
        }

        return $refer_str;
    }

    public function prepareMessage($arValues, $message_key = "MESSAGE")
    {
        foreach ($arValues as $key => $value)
        {
            if (empty($value))
            {
                continue;
            }
            $param_name = $this->getParamName($key);
            $this->message[$message_key] .= "<b>" . $param_name . "</b>: " . htmlspecialchars($value) . "<br>";
        }
        return $this->message['MESSAGE'];
    }

    private function getParamName($key)
    {
        $paramName = $key;
        $paramRuName = Loc::getMessage($key);
        if (!empty($paramRuName))
        {
            $paramName = $paramRuName;
        }
        return $paramName;
    }

    public function sendEmail($EVENT_NAME, $LID, $MESSAGE)
    {
        $result = Event::send(array("EVENT_NAME" => $EVENT_NAME, "LID" => $LID, "C_FIELDS" => $MESSAGE));
        return $result->isSuccess();
    }

}