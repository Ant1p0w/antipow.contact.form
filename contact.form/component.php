<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arUtm = $this->utmGetSave();

use Bitrix\Main\Application;

$arUtm = $this->utmGetSave();
$request = Application::getInstance()->getContext()->getRequest();

if ($request->isPost())
{
    $arRequest = $request->getPostList();
}
else
{
    $arRequest = $request->getQueryList();
}


if ($arRequest['AJAX_CALL'] == "Y" && check_bitrix_sessid())
{
    $ajaxSession = CAjax::GetSession();
    if($ajaxSession && $arParams["AJAX_ID"] != $ajaxSession)
    {
        return;
    }

    if (!empty($arParams['REQUIRED_FIELDS']))
    {
        foreach ($_REQUEST['form_fields'] as $key => $value)
        {
            if (in_array($key, $arParams['REQUIRED_FIELDS']))
            {
                if (empty($value))
                {
                    //TODO:beauty error system
                    $arResult['ERROR'][] = "Заполните все поля";
                }
            }
        }
    }

    if (empty($arResult['ERROR']))
    {
        $this->prepareMessage($_REQUEST['form_fields'], 'MESSAGE');
        $this->prepareMessage($arUtm, 'UTM');
        $this->saveFile($_FILES);
        $this->message['SUBJECT'] = $arParams['SUBJECT'] . ": " . date("d.m.y h:i:s");
        $arResult['SEND_MAIL'] = $this->sendEmail($arParams['EVENT_NAME'], SITE_ID, $this->message);
    }

    if ($arParams['SAVE_TO_BD'] == 'Y' && intval($arParams['IBLOCK_ID']) > 0)
    {
        $this->SaveToBD($this->message, $arParams['IBLOCK_ID']);
    }

}

$this->IncludeComponentTemplate();





