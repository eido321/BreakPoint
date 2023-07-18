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



// $(document).ready(function () {
//     $('.leftCommentSectionText1Icon').click(function () {
//         var grayArrow = $('.leftCommentSectionText1Icon');
//         var comments = $('#coomentSection');

//         grayArrow.css('transform', 'rotate(180deg)');

//         if (comments.css('display') === 'none') {
//             comments.css('display', 'block');
//         } else {
//             grayArrow.css('transform', 'rotate(360deg)');
//             comments.css('display', 'none');
//         }
//     });
// });

function expanedComments() {
    var grayArrow = $('.leftCommentSectionText1Icon');
    var comments = $('#coomentSection');

    grayArrow.css('transform', 'rotate(180deg)');

    if (comments.css('display') === 'none') {
        comments.css('display', 'block');
    } else {
        grayArrow.css('transform', 'rotate(360deg)');
        comments.css('display', 'none');
    }
}

function expanedCommentsMobile() {
    var grayArrow = $('#commentMobileExpandButton');
    var comments = $('#mobileComments');

    grayArrow.css('transform', 'rotate(180deg)');

    if (comments.css('display') === 'none') {
        comments.css('display', 'block');
    } else {
        grayArrow.css('transform', 'rotate(360deg)');
        comments.css('display', 'none');
    }
}


function toggleLike(button) {
    const isActive = button.getAttribute('data-is-active') === 'true';
    const span = button.querySelector('span');
    let count = parseInt(span.textContent);

    if (isActive) {
        button.style.backgroundImage = 'url(images/clapping-hands-red.png)';
        span.textContent = count + 1;
        button.setAttribute('data-is-active', 'false');
    } else {
        button.style.backgroundImage = 'url(images/clapping-hands.png)';
        span.textContent = count - 1;
        button.setAttribute('data-is-active', 'true');
    }
}


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
                colElement.style.width = "324px";
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

(() => {
    let deleteProjectButtons = document.getElementsByClassName("deleteProjectButton");
    Array.from(deleteProjectButtons).forEach((button) => {
        button.addEventListener("click", function (event) {
            let projId = document.getElementById("projIdElement").getAttribute("data-projId");
            if (projId != 0) {
                let modal = new bootstrap.Modal(document.getElementById("exampleModal3"));
                modal.show();
                event.preventDefault();
            } else {
                let modal = new bootstrap.Modal(document.getElementById("exampleModal1"));
                modal.show();
                event.preventDefault();
            }
        });
    });
})();


let =
    (() => {
        if (window.location.href.endsWith("?success")) {
            let successModal = new bootstrap.Modal(document.getElementById("successModal"));
            if (successModal != null) {
                successModal.show();
            }
        }
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

if (window.location.href.indexOf("View") !== -1) {
    const submit = document.querySelector('#sendSubmit');
    const formDesktop = document.querySelector('#addComment');
    const messageEl = document.querySelector('#loading');
    const posts = document.querySelector('#coomentSection');
    const sumComments = document.querySelectorAll('.totalComments');
    const commentInput = document.querySelector('#inputComment');
    const sortNew = document.querySelector('#newSort');
    const sortOld = document.querySelector('#oldSort');
    const newForm = document.querySelector('#newForm');
    const oldForm = document.querySelector('#oldForm');
    const sortNewMobile = document.querySelector('#newSortMobile');
    const sortOldMobile = document.querySelector('#oldSortMobile');
    const newFormMobile = document.querySelector('#newFormMobile');
    const oldFormMobile = document.querySelector('#oldFormMobile');
    const submitMobile = document.querySelector('#sendSubmitMobile');
    const formMobile = document.querySelector('#mobileCommentForm');
    const postsMobile = document.querySelector('#mobileComments');

    submit.addEventListener('click', (e) => {
        e.preventDefault();
        messageEl.innerHTML = "<span class='loading'>Loading..</span>";
        savePost(formDesktop, posts);
        expanedComments();
        sortOld.style.color = '#555555';
        sortOld.style.backgroundColor = 'white';
        sortNew.style.color = '#555555';
        sortNew.style.backgroundColor = 'white';
    });

    submitMobile.addEventListener('click', (e) => {
        e.preventDefault();
        savePost(formMobile, postsMobile);
        expanedCommentsMobile();

    });

    const savePost = async (form, posts) => {
        try {
            let response = await fetch('action.php', {
                method: 'POST',
                body: new FormData(form),
            });
            const result = await response.json();
            posts.innerHTML = result.retVal;
            sumComments[0].innerHTML = result.sumVal;
            sumComments[1].innerHTML = result.sumVal;
            commentInput.value = "";
            messageEl.style.display = "none";

        } catch (error) {
            console.log(error);
        }
    };

    sortNew.addEventListener('click', (e) => {
        e.preventDefault();
        savePost(newForm, posts);
        sortNew.style.color = 'white';
        sortNew.style.backgroundColor = '#bd362f';
        sortOld.style.color = '#555555';
        sortOld.style.backgroundColor = 'white';
        expanedComments();
    });

    sortOld.addEventListener('click', (e) => {
        e.preventDefault();
        savePost(oldFormMobile, posts);
        sortOld.style.color = 'white';
        sortOld.style.backgroundColor = '#bd362f';
        sortNew.style.color = '#555555';
        sortNew.style.backgroundColor = 'white';
        expanedComments();
    });

    sortNewMobile.addEventListener('click', (e) => {
        e.preventDefault();
        savePost(newFormMobile, postsMobile);
        sortNewMobile.style.color = 'white';
        sortNewMobile.style.backgroundColor = '#bd362f';
        sortOldMobile.style.color = '#555555';
        sortOldMobile.style.backgroundColor = 'white';
        expanedComments();
    });

    sortOldMobile.addEventListener('click', (e) => {
        e.preventDefault();
        savePost(oldFormMobile, postsMobile);
        sortOldMobile.style.color = 'white';
        sortOldMobile.style.backgroundColor = '#bd362f';
        sortNewMobile.style.color = '#555555';
        sortNewMobile.style.backgroundColor = 'white';
        expanedComments();
    });

    savePost(formDesktop, posts);
    savePost(formMobile, postsMobile);
}

if(window.location.href.indexOf("View") !== -1 ||window.location.href.indexOf("index.php") !== -1||window.location.href.indexOf("profile") !== -1){
const submitSearchSort1 = document.querySelector('#formType1Submit');
const submitSearchSort2 = document.querySelector('#formType2Submit');
const submitSearchSort3 = document.querySelector('#formType3Submit');
const submitSearchSort4 = document.querySelector('#formType4Submit');
const submitSearchSort5 = document.querySelector('#formType5Submit');
const submitSearchSort6 = document.querySelector('#formType6Submit');
const submitFormSort1 = document.querySelector('#formType1');
const submitFormSort2 = document.querySelector('#formType2');
const submitFormSort3 = document.querySelector('#formType3');
const submitFormSort4 = document.querySelector('#formType4');
const submitFormSort5 = document.querySelector('#formType5');
const submitFormSort6 = document.querySelector('#formType6');

const projectMain = document.querySelector('#projectsMain');

function resetSortColors() {
    submitSearchSort1.style.color = '#555555';
    submitSearchSort1.style.backgroundColor = 'white';
    submitSearchSort2.style.color = '#555555';
    submitSearchSort2.style.backgroundColor = 'white';
    submitSearchSort3.style.color = '#555555';
    submitSearchSort3.style.backgroundColor = 'white';
    submitSearchSort4.style.color = '#555555';
    submitSearchSort4.style.backgroundColor = 'white';
    submitSearchSort5.style.color = '#555555';
    submitSearchSort5.style.backgroundColor = 'white';
    submitSearchSort6.style.color = '#555555';
    submitSearchSort6.style.backgroundColor = 'white';
}

submitSearchSort1.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort1);
    resetSortColors();
    submitSearchSort1.style.color = 'white';
    submitSearchSort1.style.backgroundColor = '#bd362f';
});
submitSearchSort2.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort2);

    resetSortColors();
    submitSearchSort2.style.color = 'white';
    submitSearchSort2.style.backgroundColor = '#bd362f';
});
submitSearchSort3.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort3);
    resetSortColors();
    submitSearchSort3.style.color = 'white';
    submitSearchSort3.style.backgroundColor = '#bd362f';
});
submitSearchSort4.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort4);
    resetSortColors();
    submitSearchSort4.style.color = 'white';
    submitSearchSort4.style.backgroundColor = '#bd362f';
});
submitSearchSort5.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort5);
    resetSortColors();
    submitSearchSort5.style.color = 'white';
    submitSearchSort5.style.backgroundColor = '#bd362f';
});
submitSearchSort6.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort6);
    resetSortColors();
    submitSearchSort6.style.color = 'white';
    submitSearchSort6.style.backgroundColor = '#bd362f';
});


const submitSearchSort1Mobile = document.querySelector('#formType1SubmitMobile');
const submitSearchSort2Mobile = document.querySelector('#formType2SubmitMobile');
const submitSearchSort3Mobile = document.querySelector('#formType3SubmitMobile');
const submitSearchSort4Mobile = document.querySelector('#formType4SubmitMobile');
const submitSearchSort5Mobile = document.querySelector('#formType5SubmitMobile');
const submitSearchSort6Mobile = document.querySelector('#formType6SubmitMobile');
const submitFormSort1Mobile = document.querySelector('#formTypeMobile1');
const submitFormSort2Mobile = document.querySelector('#formTypeMobile2');
const submitFormSort3Mobile = document.querySelector('#formTypeMobile3');
const submitFormSort4Mobile = document.querySelector('#formTypeMobile4');
const submitFormSort5Mobile = document.querySelector('#formTypeMobile5');
const submitFormSort6Mobile = document.querySelector('#formTypeMobile6');


function resetSortColorsMobile() {
    submitSearchSort1Mobile.style.color = '#555555';
    submitSearchSort1Mobile.style.backgroundColor = 'white';
    submitSearchSort2Mobile.style.color = '#555555';
    submitSearchSort2Mobile.style.backgroundColor = 'white';
    submitSearchSort3Mobile.style.color = '#555555';
    submitSearchSort3Mobile.style.backgroundColor = 'white';
    submitSearchSort4Mobile.style.color = '#555555';
    submitSearchSort4Mobile.style.backgroundColor = 'white';
    submitSearchSort5Mobile.style.color = '#555555';
    submitSearchSort5Mobile.style.backgroundColor = 'white';
    submitSearchSort6Mobile.style.color = '#555555';
    submitSearchSort6Mobile.style.backgroundColor = 'white';
}

submitSearchSort1Mobile.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort1Mobile);
    resetSortColorsMobile();
    submitSearchSort1Mobile.style.color = 'white';
    submitSearchSort1Mobile.style.backgroundColor = '#bd362f';
});
submitSearchSort2Mobile.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort2Mobile);
    resetSortColorsMobile();
    submitSearchSort2Mobile.style.color = 'white';
    submitSearchSort2Mobile.style.backgroundColor = '#bd362f';
});
submitSearchSort3Mobile.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort3Mobile);
    resetSortColorsMobile();
    submitSearchSort3Mobile.style.color = 'white';
    submitSearchSort3Mobile.style.backgroundColor = '#bd362f';
});
submitSearchSort4Mobile.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort4Mobile);
    resetSortColorsMobile();
    submitSearchSort4Mobile.style.color = 'white';
    submitSearchSort4Mobile.style.backgroundColor = '#bd362f';
});
submitSearchSort5Mobile.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort5Mobile);
    resetSortColorsMobile();
    submitSearchSort5Mobile.style.color = 'white';
    submitSearchSort5Mobile.style.backgroundColor = '#bd362f';
});
submitSearchSort6Mobile.addEventListener('click', (e) => {
    e.preventDefault();
    saveSort(submitFormSort6Mobile);
    resetSortColorsMobile();
    submitSearchSort6Mobile.style.color = 'white';
    submitSearchSort6Mobile.style.backgroundColor = '#bd362f';
});


const saveSort = async (form) => {
    try {
        let response = await fetch('actionSearchSort.php', {
            method: 'POST',
            body: new FormData(form),
        });
        const result = await response.json();
        projectMain.innerHTML = result.retVal;
    } catch (error) {
        console.log(error);
    }
};
}

if (window.location.href.indexOf("Profile") !== -1) {
    const editProfileButton = document.querySelector("#editProfile");
    const cancelProfileButton = document.querySelector("#cancelProfile");
    const submitProfileButton = document.querySelector("#submitProfile");
    const formProfileFields = document.querySelectorAll(".profileField");

    cancelProfileButton.addEventListener("click", (event) => {
        event.preventDefault();
      });
    function enterEditModeProfile() {
        cancelProfileButton.style.display = 'block';
        submitProfileButton.style.display = 'block';
        editProfileButton.style.display = 'none'
        for (const profileField of formProfileFields) {
            profileField.removeAttribute("disabled");
        }
    }
    function exitEditModeProfile() {
        cancelProfileButton.style.display = 'none';
        submitProfileButton.style.display = 'none';
        editProfileButton.style.display = 'block'
        for (const profileField of formProfileFields) {
            profileField.setAttribute("disabled", "disabled");
        }
    }
}