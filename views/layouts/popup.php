<label class="popup-shower" for="popupCheckBox">Обратная связь</label>
<div class="popup-wrapper">
    <input type="checkbox" class="popup-checkbox" id="popupCheckBox">
    <div class="popup">
        <div class="popup-content">
            <label class="popup-closer" for="popupCheckBox">&#215;</label>
            <div class="feedback-content">
                <h2>Обратная связь</h2>
                <form name="contact" id="feedback-form" method="post" action="/feedback" onsubmit="return false">
                    <div class="row">
                        <div class="label">
                            <label for="name">Ваше имя</label><div class="error error-name"></div>
                        </div>
                        <input type="text" name="name" id="name" class="txt" placeholder="Введите имя" tabindex="1">
                    </div>
                    <div class="row">
                        <div class="label">
                            <label for="phone">Телефон</label><div class="error error-phone"></div>
                        </div>
                        <input type="text" name="phone" id="phone" class="txt" placeholder="Введите телефон" tabindex="2">
                    </div>
                    <div class="row">
                        <div class="label">
                            <label for="email">Email</label><div class="error error-email"></div>
                        </div>
                        <input type="text" name="email" id="email" class="txt" placeholder="Введите Email" tabindex="3">
                    </div>
                    <div class="row">
                        <div class="label">
                            <label for="message">Сообщение</label><div class="error error-message"></div>
                        </div>
                        <textarea name="message" id="message" class="txtarea" placeholder="Введите сообщение" tabindex="4"></textarea>
                    </div>
                    <div class="feedback-button">
                        <input type="submit" name="submitbtn" id="submitbtn" value="Отправить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="popup-success-wrapper">
    <div class="popup-success"></div>
</div>
