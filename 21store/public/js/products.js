let expanded = false;

function showCheckboxes() {
    const checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}

function toggleCheckbox(source) {
    checkboxes = document.getElementsByClassName("brand-checkbox-item");
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}
