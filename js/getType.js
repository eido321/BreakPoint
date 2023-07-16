function showData(data) {
    if (window.location.href.indexOf("indexForm") !== -1) {
        let options = document.querySelectorAll(".typeOption");
        let i = 0;
        for (const option of options) {
            option.value = `${data.projectTypes[i].projectType}`;
            option.innerHTML = `${data.projectTypes[i].projectType}`;
            i++;
        }
    }
}

fetch("data/categories.json")
    .then(response => response.json())
    .then(data => showData(data));