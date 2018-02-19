# antipow.contact.form
Компонент для Bitrix. Механизм формы обратной связи с сохранением UTM меток в сессии и куках. 

<? $APPLICATION->IncludeComponent(
                    "antipow:contact.form",
                    "",
                    array(
                        "COMPONENT_TEMPLATE"     => "main_page",
                        "EVENT_NAME"             => "ZAYAVKA",
                        "SUBJECT"                => "Сообщение с формы обратной связи",
                        "REQUIRED_FIELDS"        => array(
                            0 => "phone",
                            1 => "",
                        ),
                        "SUCCESS_MESSAGE"        => "Спасибо, Ваша заявка отправлена!",
                        "SAVE_TO_BD"             => "N",
                        "IBLOCK_ID"              => "",
                        "AJAX_MODE"              => "Y",
                        "AJAX_OPTION_JUMP"       => "Y",
                        "AJAX_OPTION_STYLE"      => "Y",
                        "AJAX_OPTION_HISTORY"    => "N",
                        "AJAX_OPTION_ADDITIONAL" => ""
                    ),
                    false
                ); ?>
