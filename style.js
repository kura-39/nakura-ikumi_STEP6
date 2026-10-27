
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const footer = document.querySelector("footer");
    const colorButton = document.getElementById("changeFooterColor");

    // フッターの色を青 → 赤 → 黄 → グレーの順に変更
    const colors = ["blue", "red", "yellow", "gray"];
    let colorIndex = 0;

    if (colorButton && footer) {
        colorButton.addEventListener("click", function () {
            footer.style.backgroundColor = colors[colorIndex];
            colorIndex = (colorIndex + 1) % colors.length;
        });
    }

    if (!form) {
        return;
    }

    const fields = ["name", "companyName", "email", "age", "message"];
    const storageKey = "cytechContactForm";

    // 保存された入力内容を復元する
    try {
        const savedData = sessionStorage.getItem(storageKey);

        if (savedData) {
            const data = JSON.parse(savedData);

            fields.forEach(function (fieldName) {
                const field = form.elements.namedItem(fieldName);

                if (field && typeof data[fieldName] === "string") {
                    field.value = data[fieldName];
                }
            });
        }
    } catch (error) {
        console.warn("入力内容を復元できませんでした。", error);
    }

    // 入力するたびに内容を一時保存する
    function saveFormData() {
        const data = {};

        fields.forEach(function (fieldName) {
            const field = form.elements.namedItem(fieldName);

            if (field) {
                data[fieldName] = field.value;
            }
        });

        try {
            sessionStorage.setItem(storageKey, JSON.stringify(data));
        } catch (error) {
            console.warn("入力内容を保存できませんでした。", error);
        }
    }

    fields.forEach(function (fieldName) {
        const field = form.elements.namedItem(fieldName);

        if (field) {
            field.addEventListener("input", saveFormData);
        }
    });

    // 送信前の入力チェックと確認
    form.addEventListener("submit", function (event) {
        saveFormData();

        const values = {};

        fields.forEach(function (fieldName) {
            const field = form.elements.namedItem(fieldName);
            values[fieldName] = field ? field.value.trim() : "";
        });

        if (fields.some(function (fieldName) {
            return values[fieldName] === "";
        })) {
            event.preventDefault();
            alert("すべての項目を入力してください。");
            return;
        }

        const confirmation =
            "以下の内容で送信しますか？\n\n" +
            "お名前：" + values.name + "\n" +
            "会社名：" + values.companyName + "\n" +
            "メールアドレス：" + values.email + "\n" +
            "年齢：" + values.age + "\n" +
            "お問い合わせ内容：" + values.message;

        if (!window.confirm(confirmation)) {
            event.preventDefault();
        }
    });
});
