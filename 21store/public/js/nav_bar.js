const input = document.getElementById("search-input");
input.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
        event.preventDefault();
        alert(`Searching: ${input.value}`);
    }
});
