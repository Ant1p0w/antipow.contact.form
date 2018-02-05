<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "GROUPS"     => array(),
    "PARAMETERS" => array(
        "EVENT_NAME"        => array(
            "PARENT"  => "BASE",
            "NAME"    => "Название почтового события",
            "TYPE"    => "TEXT",
            "VALUES"  => "",
            "DEFAULT" => "ZAYAVKA",
            "REFRESH" => "Y",
        ),
        "SUBJECT"         => array(
            "PARENT"  => "BASE",
            "NAME"    => "Заголовок сообщения",
            "TYPE"    => "TEXT",
            "VALUES"  => "",
            "DEFAULT" => "Сообщение с формы обратной связи",
            "REFRESH" => "Y",
        ),
        "REQUIRED_FIELDS" => array(
            "PARENT"   => "BASE",
            "NAME"     => "Обязательные поля",
            "TYPE"     => "TEXT",
            "MULTIPLE" => "Y",
            "VALUES"   => "",
            "DEFAULT"  => array("phone"),
            "REFRESH"  => "Y",
        ),
        "SUCCESS_MESSAGE" => array(
            "PARENT"  => "BASE",
            "NAME"    => "Сообщение об успешной отправке",
            "TYPE"    => "TEXT",
            "VALUES"  => "",
            "DEFAULT" => "Спасибо, Ваша заявка отправлена!",
            "REFRESH" => "Y",
        ),
        "SAVE_TO_BD" => array(
            "PARENT"  => "BASE",
            "NAME"    => "Сохранять сообщение в инфоблок",
            "TYPE"    => "CHECKBOX",
            "VALUES"  => "",
            "DEFAULT" => "N",
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT"  => "BASE",
            "NAME"    => "ID инфоблока заявок",
            "TYPE"    => "TEXT",
            "VALUES"  => "",
            "DEFAULT" => "",
            "REFRESH" => "Y",
        ),
        "AJAX_MODE"       => array(
            "DEFAULT" => "Y"
        )
    )
);
?>