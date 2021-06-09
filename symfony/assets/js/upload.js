require("./croppie");
import "../styles/croppie.css";

document.addEventListener("DOMContentLoaded", function () {
  let myModal = new bootstrap.Modal(document.getElementById("croppie-modal"), {
    keyboard: false,
    backdrop: true,
  });

  let myModalBtn = document.querySelector("#croppie-modal .btn.btn-primary");
  let myInput = document.getElementById("team_form_photo");
  var exampleEl = document.getElementById("drag-tool-tip");
  exampleEl &&
    new bootstrap.Tooltip(exampleEl, {
      title: "Drag and drop or browser",
    });

  if (myModal && myInput) {
    var basic = $("#demo-basic").croppie({
      viewport: {
        width: 250,
        height: 250,
        type: "square",
      },
      boundary: {
        width: 300,
        height: 300,
      },
      customClass: "m-auto",
      showZoomer: true,
      enableOrientation: false,
    });

    myModalBtn.addEventListener("click", function () {
      basic
        .croppie("result", "blob", "viewport", "jpg", 1)
        .then(function (data) {
          var reader = new FileReader();
          reader.readAsDataURL(data);
          reader.onloadend = function () {
            let img = [...document.getElementById("avatar").children];
            if (img && img.length > 0)
              img.forEach((e) => {
                if (e.src) e.src = reader.result;
                if (e.srcset) e.srcset = reader.result;
              });
          };

          function FileListItems(files) {
            var b = new ClipboardEvent("").clipboardData || new DataTransfer();
            for (var i = 0, len = files.length; i < len; i++)
              b.items.add(files[i]);
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
      myModal.toggle();
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
        zoom: 0.2,
        points: [10, 10, 10, 10],
      });

      myModal.show();
    }

    myInput.addEventListener("change", () => {
      fileToDataImg();
    });
  }
});
