function showData(data) {
    if (window.location.href.indexOf("indexForm") !== -1) {
        let options = document.querySelectorAll(".typeOption");
        let i = 0;
        for (const option of options) {
            option.value = `${data.categories[i].category}`;
            option.innerHTML = `${data.categories[i].category}`
            i++;
        }
    }
}

fetch("data/categories.json")
    .then(response => response.json())
    .then(data => showData(data));