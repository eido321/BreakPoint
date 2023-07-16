function showData(data) {
    if (window.location.href.indexOf("indexForm") !== -1) {
        let options = document.querySelectorAll(".typeOption");
        let i = 0;
        for (const option of options) {
            option.value = `${data.projectTypes[i].id}`;
            option.innerHTML = `${data.projectTypes[i].projectType}`;
            i++;
        }
    }
    if (window.location.href.indexOf("index.php") !== -1) {
        let options = document.querySelectorAll(".typeOption");
        let i = 0;
        let count = 1
        for (const option of options) {
            option.value = `${data.projectTypes[i].id}`;
            option.innerHTML = `${data.projectTypes[i].projectType}`;
            if (count == 2) {
                i++;
                count = 0;
            }
            count++;
        }
    }
}

fetch("data/categories.json")
    .then(response => response.json())
    .then(data => showData(data));