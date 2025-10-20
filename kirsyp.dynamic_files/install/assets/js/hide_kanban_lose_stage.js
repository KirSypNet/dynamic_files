document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener("load", function () {
    const elements = document.querySelectorAll(".main-kanban-dropzone");

    elements.forEach((element) => {
      const dataId = $(element).attr("data-id");

      if (dataId && dataId.includes("LOSE")) {
        $(element).hide();
      }
    });

    function hideLoseColumns() {
      $(".main-kanban-column.main-kanban-column-droppable").each(function () {
        if (
          $(this)
            .find(".main-kanban-column-body")
            .attr("data-id")
            .includes("LOSE")
        ) {
          $(this).hide();
        }
      });

      $(".popup-window.main-ui-select-inner").each(function () {
        if ($(this)) {
          const popupList = $(this).find(".popup-multiselect-content");
          if (popupList) {
            const listElem = popupList.find("div");
            if (listElem) {
              listElem.each(function () {
                const dataItem = $(this).attr("data-item");
                if (dataItem) {
                  if (
                    dataItem.includes("LOSE") ||
                    dataItem.includes('"VALUE":"F"')
                  ) {
                    $(this).hide();
                  }
                }
              });
            }
          }
        }
      });
    }

    hideLoseColumns();

    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.addedNodes.length) {
          hideLoseColumns();
        }
      });
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  });
});
