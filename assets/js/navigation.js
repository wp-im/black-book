(function () {
  var body = document.body;
  var toggle = document.querySelector(".fwc-menu-toggle");
  var nav = document.getElementById("site-navigation");

  if (!body || !toggle || !nav) {
    return;
  }

  body.classList.add("fwc-navigation-ready");

  function setOpen(isOpen) {
    body.classList.toggle("black-book-menu-open", isOpen);
    toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
  }

  toggle.addEventListener("click", function () {
    var isOpen = !body.classList.contains("black-book-menu-open");
    setOpen(isOpen);
    if (isOpen) {
      var firstLink = nav.querySelector("a");
      if (firstLink) {
        firstLink.focus();
      }
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape" && body.classList.contains("black-book-menu-open")) {
      setOpen(false);
      toggle.focus();
    }
  });

  nav.addEventListener("click", function (event) {
    if (event.target.closest("a") && body.classList.contains("black-book-menu-open")) {
      setOpen(false);
    }
  });

  var mobile = window.matchMedia("(max-width: 980px)");
  mobile.addEventListener("change", function () {
    setOpen(false);
  });
})();
