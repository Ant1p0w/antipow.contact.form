<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$this->createFrame()->begin("Загрузка");
?>

<? if ($arResult['SEND_MAIL']) { ?>
    <div class="alert alert-success text-center" role="alert">
        <?= $arParams['SUCCESS_MESSAGE'] ?>
    </div>
<? } else { ?>
    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" class="popup default-contact-form">
        <div class="with-border mb-3">
            <input type="tel" name="form_fields[PHONE]" placeholder="ТЕЛЕФОН*" required>
            <input type="email" name="form_fields[EMAIL]" placeholder="EMAIL">
            <textarea name="form_fields[MESSAGE]" rows="3" placeholder="ВАШ ВОПРОС"></textarea>
        </div>
        <div class="form-group">
            <div class="row justify-content-center align-items-center">
                <div class="col-12">
                    <div class="form-check">
                        <label class="form-check-label ml-1" style="cursor: pointer">
                            <input class="form-check-input" type="checkbox" value="" required checked>
                            <span style="color: #6b6b6b">Я согласен на обработку персональных данных</span>
                        </label>
                    </div>
                </div>
                <div class="col-auto my-4">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>
    </form>
<? } ?>