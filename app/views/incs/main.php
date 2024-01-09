<?php

/** @var $validator */
?>

<main class="main">
    <div class="container">

        <div class="main-form">
            <form action="index" method="POST" class="form">
                <div class="form__item item-form">
                    <div class="item-form__title">Name</div>
                    <div class="item-form__input"><input type="text" name="name" value="<?= old('name') ?>"></div>
                    <?= $validator->hasError() ? $validator->output('name') : '' ?>
                </div>
                <div class="form__item item-form">
                    <div class="item-form__title">Email</div>
                    <div class="item-form__input"><input type="email" name="email" value="<?= old('email') ?>"></div>
                    <?= $validator->hasError() ? $validator->output('email') : '' ?>
                </div>
                <div class="form__item item-form">
                    <div class="item-form__title">Phone</div>
                    <div class="item-form__input"><input type="tel" name="phone" class="form-phone" value="<?= old('phone') ?>" placeholder="+7 (123) 123-45-67"></div>
                    <?= $validator->hasError() ? $validator->output('phone') : '' ?>
                </div>
                <div class="form__item item-form">
                    <div class="item-form__title">Price</div>
                    <div class="item-form__input"><input type="number" name="price" value="<?= old('price') ?>"></div>
                    <?= $validator->hasError() ? $validator->output('price') : '' ?>
                </div>
                <div class="form__button">
                    <button class="form__btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>