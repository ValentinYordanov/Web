var fileInput = document.getElementById('file-input');
var fileList = [];

fileInput.addEventListener('change', function (evnt) {
  fileList = [];
  for (var i = 0; i < fileInput.files.length; i++) {
    fileList.push(fileInput.files[i]);
  }
})

var fileCatcher = document.getElementById('file-catcher');

fileCatcher.addEventListener('submit', function (evnt) {
  evnt.preventDefault();
  if (fileList) {
    sendFile(fileList);
    // fileList.forEach(function (file) {
    //   sendFile(file);
    // })
  }
})
//fd.append("fileToUpload[]", document.getElementById('fileToUpload').files[0]);

sendFile = function (files) {
  var formData = new FormData();
  var request = new XMLHttpRequest();

  request.onload = function () {
    if (request.status === 400) {
      alert(JSON.parse(request.responseText)['error']);
    }
  }

  for (var i = 0; i < files.length; i++) {
    formData.append('files[]', files[i]);
  }
  request.open("POST", 'saveImages.php');
  request.send(formData);
}