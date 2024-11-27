import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.getElementById("theme-toggle").addEventListener("click", () => {
    const currentTheme = document.documentElement.classList.contains("dark")
        ? "dark"
        : "light";
    const newTheme = currentTheme === "dark" ? "light" : "dark";

    // Update kelas tema
    document.documentElement.classList.toggle("dark", newTheme === "dark");

    // Simpan preferensi tema ke cookie
    document.cookie = `theme=${newTheme}; path=/; max-age=31536000; SameSite=Lax`;
});
