document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener("load", function () {
    // Функция для проверки и клика по кнопке
    function checkAndClickPopup() {
      const popup = document.querySelector(
        ".popup-window.crm-list-end-deal.--open"
      );
      if (popup) {
        const button = popup.querySelector(
          ".webform-small-button.webform-small-button-accept"
        );
        if (button) {
          button.click();
        }
      }
    }

    // Создаем наблюдатель за изменениями в DOM
    const observer = new MutationObserver(function (mutations) {
      for (const mutation of mutations) {
        for (const node of mutation.addedNodes) {
          // Проверяем сам добавленный элемент
          if (
            node.nodeType === Node.ELEMENT_NODE &&
            node.classList.contains("popup-window") &&
            node.classList.contains("crm-list-end-deal") &&
            node.classList.contains("--open")
          ) {
            checkAndClickPopup();
            return;
          }

          // Проверяем детей добавленного элемента
          if (
            node.nodeType === Node.ELEMENT_NODE &&
            node.querySelector(".popup-window.crm-list-end-deal.--open")
          ) {
            checkAndClickPopup();
            return;
          }
        }
      }
    });

    // Начинаем наблюдение за DOM
    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });

    // Также проверяем при загрузке страницы (на случай если попап уже есть)
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", checkAndClickPopup);
    } else {
      checkAndClickPopup();
    }
  });
});
