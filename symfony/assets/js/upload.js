require("./croppie");
import "../styles/croppie.css";

document.addEventListener("DOMContentLoaded", function () {
  var myModal = new bootstrap.Modal(document.getElementById("croppie-modal"), {
    keyboard: false,
    backdrop: true,
  });
  var myModalBtn = document.querySelector("#croppie-modal .btn.btn-primary");
  let myInput = document.getElementById("team_form_photo");

  var basic = $("#demo-basic").croppie({
    viewport: {
      width: 150,
      height: 150,
      type: "square",
    },
    boundary: {
      width: 200,
      height: 200,
    },
    customClass: "m-auto",
    showZoomer: true,
    enableOrientation: false,
  });

  myModalBtn.addEventListener("click", function () {
    basic.croppie("result", "blob", "viewport", "jpg", 1).then(function (data) {
      console.log(data);

      function FileListItems(files) {
        var b = new ClipboardEvent("").clipboardData || new DataTransfer();
        for (var i = 0, len = files.length; i < len; i++) b.items.add(files[i]);
        return b.files;
      }

      let imgName = myInput.files[0].name;

      var files = [
        new File([data], imgName, {
          type: "image/jpeg",
          lastModified: new Date().getTime(),
        }),
      ];

      myInput.files = new FileListItems(files);
    });
  });

  async function fileToDataImg() {
    let dataImg = document.getElementById("team_form_photo");
    dataImg = dataImg.files[0];

    const convertImg = (dataImg) => {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(dataImg);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
      });
    };

    const file = await convertImg(dataImg);

    basic.croppie("bind", {
      url: file,
    });

    myModal.show();
  }

  myInput.addEventListener("change", () => {
    fileToDataImg();
  });
});
