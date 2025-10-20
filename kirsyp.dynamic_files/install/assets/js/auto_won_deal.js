document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener("load", function () {
    // поиск кнопки завершения сделки
    const elements = document.querySelectorAll(
      ".crm-entity-section-status-step"
    );
    elements.forEach((element) => {
      const dataId = $(element).attr("data-id");

      if (dataId && dataId.includes("WON")) {
        // вышаем событие на клик по элементу завершения сделки
        element.addEventListener("click", () => {
          const clickButton = () => {
            // ищем кнопку во всплывающем окне выбора варианта завершения сделки
            const button = document.querySelector(
              "#entity_progress_TERMINATION .webform-small-button-accept"
            );
            // если нашли кнопку
            if (button) {
              // эмулируем нажатие кнопки
              button.click();
              return true;
            }
            // кнопка не найдена
            return false;
          };
          // проверяем, существует ли кнопка сразу после клика
          if (clickButton()) return;
        });
      }
    });
  });
});
