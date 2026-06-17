(function () {

    function applyTheme(theme) {

        if (theme === "dark") {
            document.documentElement.setAttribute("data-theme", "dark");
        } else {
            document.documentElement.removeAttribute("data-theme");
        }

    }

    const savedTheme = localStorage.getItem("theme") || "light";

    applyTheme(savedTheme);

    window.toggleTheme = function () {

        const currentTheme =
            document.documentElement.getAttribute("data-theme") === "dark"
                ? "dark"
                : "light";

        const newTheme =
            currentTheme === "dark"
                ? "light"
                : "dark";

        localStorage.setItem("theme", newTheme);

        applyTheme(newTheme);

    };

})();
