var hamburgerButton = $('#humburger');
var ranProfileImage = $('.ranProfileImage');
var searchBar = $('#searchBar1');
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


const cancelButton = document.getElementById('cancel');

if (cancelButton) {
    cancelButton.addEventListener('click', function (event) {
        event.preventDefault();
    });
}
let goBack = function () {
    history.back();
};

$(document).ready(function () {
    $('.leftCommentSectionText1Icon').click(function () {
        var grayArrow = $('.leftCommentSectionText1Icon');
        var comments = $('#coomentSection');

        grayArrow.css('transform', 'rotate(180deg)');

        if (comments.css('display') === 'none') {
            comments.css('display', 'block');
        } else {
            grayArrow.css('transform', 'rotate(360deg)');
            comments.css('display', 'none');
        }
    });
});


const $likes = $('.ClappImage');

$likes.on('click', function () {
    const $like = $(this);
    const isActive = Boolean($like.attr('data-is-active') === 'true');
    if (isActive) {
        $like.css('background-image', 'url(images/clapping-hands-red.png)');
        const $span = $like.find('span');
        let count = parseInt($span.text());
        $span.text(count + 1);
        $like.attr('data-is-active', 'false');
    } else {
        $like.css('background-image', 'url(images/clapping-hands.png)');
        const $span = $like.find('span');
        let count = parseInt($span.text());
        $span.text(count - 1);
        $like.attr('data-is-active', 'true');
    }
});










if (document.getElementById("formFunc")) {

    const inputElement = document.getElementById("inputGroupFile01");
    const fileCountElement = document.getElementById("fileCount");
    inputElement.addEventListener("change", handleFiles, false);
    let files = [];
    function handleFiles() {
        const fileList = this.files;

        for (let i = 0; i < fileList.length; i++) {
            files.push(fileList[i]);
        }
        displayFileList();
    }
    function displayFileList() {
        const fileListContainer = document.getElementById("fileListContainer");
        fileListContainer.innerHTML = "";
        for (let i = 0; i < files.length; i++) {
            const fileName = files[i].name;
            const listItem = document.createElement("li");
            listItem.textContent = fileName;
            const removeIcon = document.createElement("div");
            removeIcon.classList.add("remove-icon");
            removeIcon.addEventListener("click", function () {
                files.splice(i, 1);
                displayFileList();
            });
            listItem.appendChild(removeIcon);
            fileListContainer.appendChild(listItem);
        }
        fileCountElement.textContent = `${files.length} file${files.length !== 1 ? 's' : ''}`;
    }
}


let gridOragnize = function () {
    let screenWidth = window.innerWidth;
    let colElements = Array.from(document.getElementsByClassName("col"));
    let rowElements = Array.from(document.getElementsByClassName("row"));

    if (screenWidth <= 1032) {
        colElements.forEach(function (colElement) {
            if (!colElement.hasChildNodes()) {
                colElement.style.display = "none";
            }
        });
        rowElements.forEach(function (rowElement) {
            rowElement.style.marginBottom = "0";
        });
    } else {
        colElements.forEach(function (colElement) {
            if (!colElement.hasChildNodes()) {
                colElement.style.display = "initial";
            }
        });
        rowElements.forEach(function (rowElement) {
            rowElement.style.marginBottom = "70px";
        });
    }
};

window.onload = function () {
    gridOragnize();
};

window.addEventListener("resize", function () {
    gridOragnize();
});
(() => {
    let indexViewButtons = document.getElementsByClassName("indexViewButton");
    Array.from(indexViewButtons).forEach((button) => {
        button.addEventListener("click", function (event) {
            let projId = document.getElementById("projIdElement").getAttribute("data-projId");
            if (projId == 0) {
                let modal = new bootstrap.Modal(document.getElementById("exampleModal1"));
                modal.show();
                event.preventDefault();
            }
        });
    });
})();

(() => {
    let editButtons = document.getElementsByClassName("editButton");
    Array.from(editButtons).forEach((button) => {
        button.addEventListener("click", function (event) {
            let projId = document.getElementById("projIdElement").getAttribute("data-projId");
            if (projId == 0) {
                let modal = new bootstrap.Modal(document.getElementById("exampleModal1"));
                modal.show();
                event.preventDefault();
            }
        });
    });
})();

(() => {
    let addProjectButtons = document.getElementsByClassName("addProjectButton");
    Array.from(addProjectButtons).forEach((button) => {
        button.addEventListener("click", function (event) {
            let projId = document.getElementById("projIdElement").getAttribute("data-projId");
            if (projId != 0) {
                let modal = new bootstrap.Modal(document.getElementById("exampleModal2"));
                modal.show();
                event.preventDefault();
            }
        });
    });
})();


let creativityElements = document.getElementsByClassName("StarCn");

Array.from(creativityElements).forEach((element) => {
    let creativityRating = element.getAttribute("data-rating");

    for (let i = 0; i < creativityRating; i++) {
        const div = document.createElement('div');
        div.classList.add('stars');
        element.appendChild(div);
    }

    for (let i = 0; i < 5 - creativityRating; i++) {
        const div = document.createElement('div');
        div.classList.add('stars2');
        element.appendChild(div);
    }
});

