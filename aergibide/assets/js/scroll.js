window.addEventListener("beforeunload", function () {
  sessionStorage.setItem("scrollPosition", window.scrollY);
});

document.addEventListener("DOMContentLoaded", function () {
  if (window.location.hash === "#scrollPosition") {
    if (sessionStorage.getItem("scrollPosition")) {
      window.scrollTo(0, sessionStorage.getItem("scrollPosition"));
      sessionStorage.removeItem("scrollPosition");
    }
  }
});
