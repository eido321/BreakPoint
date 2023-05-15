var hamburgerButton = $('#humburger');
var ranProfileImage = $('#ranProfileImage');
var searchBar = $('#searchBar');
var logo = $('#logoExpanded');

hamburgerButton.click(function () {
    if (hamburgerButton.hasClass("collapsed")) {
        logo.fadeOut(function () {
            ranProfileImage.fadeIn();
            searchBar.fadeIn();
        });
    } else {
        ranProfileImage.fadeOut();
        searchBar.fadeOut(function () {
            logo.fadeIn();
        });
    }
});

(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

let goBack = function () {
    $("#cancel").on("click", function () {
        history.back();
    });
};


const inputElement = document.getElementById("inputGroupFile01");
const fileCountElement = document.getElementById("fileCount");
inputElement.addEventListener("change", handleFiles, false);

let files = [];

function handleFiles() {
    const fileList = this.files;

    for (let i = 0; i < fileList.length; i++) {
        files.push(fileList[i]);
    }

    // do something with the files array, like display a list of file names
    displayFileList();
}

function displayFileList() {
    const fileListContainer = document.getElementById("fileListContainer");
    fileListContainer.innerHTML = "";

    for (let i = 0; i < files.length; i++) {
        const fileName = files[i].name;
        const listItem = document.createElement("li");
        listItem.textContent = fileName;

        // create a remove icon to remove the file from the list
        const removeIcon = document.createElement("div");
        removeIcon.classList.add("remove-icon");
        removeIcon.addEventListener("click", function () {
            // remove the file from the array and re-render the list
            files.splice(i, 1);
            displayFileList();
        });

        // add the remove icon to the list item
        listItem.appendChild(removeIcon);

        // add the list item to the file list container
        fileListContainer.appendChild(listItem);
    }

    // update the file count in the input field
    fileCountElement.textContent = `${files.length} file${files.length !== 1 ? 's' : ''}`;
}
