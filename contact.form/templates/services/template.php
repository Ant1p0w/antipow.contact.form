<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$this->createFrame()->begin("Загрузка");
?>

<? if ($arResult['SEND_MAIL']) { ?>
    <div class="alert alert-success text-center" role="alert">
        <?= $arParams['SUCCESS_MESSAGE'] ?>
    </div>
<? } else { ?>
    <div id="services-form">
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" onsubmit="sendTarget('services');return true;">
            <div class="bordered">
                <input name="product" placeholder="Продукция для сертификации *" required>
                <input name="name" placeholder="Имя / название компании * " required>
                <input name="tn_ved" placeholder="Код тн вэд">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <input type="tel" name="form_fields[PHONE]" placeholder="ТЕЛЕФОН*" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="form_fields[EMAIL]" placeholder="EMAIL">
                    </div>
                </div>
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
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<? } ?>