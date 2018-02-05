<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$this->createFrame()->begin("Загрузка");
?>

<? if ($arResult['SEND_MAIL']) { ?>
    <div class="alert alert-success text-center" role="alert">
        <div class="alert alert-success text-center" role="alert">
            <?= $arParams['SUCCESS_MESSAGE'] ?>
        </div>
    </div>
<? } else { ?>
    <div class="default-contact-form">
        <h2 class="mb-5"><?= getMessage("FORM_TITLE"); ?></h2>
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" onsubmit="sendTarget('services');return true;">
            <div class="bordered">
                <input type="tel" name="form_fields[PHONE]" placeholder="ТЕЛЕФОН*" required>
                <input type="email" name="form_fields[EMAIL]" placeholder="EMAIL">
                <textarea name="form_fields[MESSAGE]" rows="3" placeholder="ВАШ ВОПРОС"></textarea>
            </div>
            <div class="form-group">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="form-check">
                            <label class="form-check-label ml-1" style="cursor: pointer">
                                <input class="form-check-input" type="checkbox" value="" required checked>
                                <span style="color: #6b6b6b">Я согласен на обработку персональных данных</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"><?= getMessage("SEND_BUTTON"); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<? } ?>