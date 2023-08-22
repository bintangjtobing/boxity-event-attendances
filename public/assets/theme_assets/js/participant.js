const imageUpload = document.querySelector(".upload-file");

if (imageUpload !== null) {
    imageUpload.addEventListener("change", uploadFile, false);
}

function uploadFile() {
    let file = event.target.files[0]; // Get the first selected file
    let uploadedList = $(".uploaded-files-list");
    uploadedList.empty(); // Clear the list before adding a new file

    if (window.File && window.FileList && window.FileReader && file) {
        let fileReader = new FileReader();
        fileReader.addEventListener("load", function (event) {
            let targetFile = event.target;
            let fileName = `
                <li>
                    <a href="#" class="file-name"><i class="las la-paperclip"></i> <span class="name-text">${file.name}</span></a>
                    <a href="#" class="btn-delete"><i class="la la-trash"></i></a>
                </li>
            `;

            let listItem = $(fileName); // Convert string to jQuery object
            let deleteButton = listItem.find('.btn-delete');
            deleteButton.on('click', function () {
                listItem.remove(); // Remove the corresponding list item when delete button is clicked
                $('.upload-file').val(''); // Clear the input file field
            });

            uploadedList.append(listItem);
        });

        fileReader.readAsDataURL(file);
    } else {
        console.log("Browser not support");
    }
}


