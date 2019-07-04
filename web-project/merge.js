function merge(album_to_be_merged, album_to_be_merged_into) {
    var formData = new FormData();
    var request = new XMLHttpRequest();

    request.onload = function () {
        getImages(document.getElementById('album-to-be-merged-into').value);
    }

    formData.append('album_to_be_merged', album_to_be_merged);
    formData.append('album_to_be_merged_into', album_to_be_merged_into);

    request.open("POST", 'merge.php');
    request.send(formData);
}