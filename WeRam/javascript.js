function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};
function ShowHideDiv() {
  let currentStudent = document.getElementById("currentStudent");
  let grade = document.getElementById("grade1");
  grade.style.display = currentStudent.checked ? "block" : "none";
}

// initialize hidden elements
window.onload = function () {
  document.getElementById("positionBigImage").style.display = "block";
  document.getElementById("lightbox").style.display = "none";
};
function showPassword() {
  let x = document.getElementById("Password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

let globalJsonData;
let currentUid;

// change the visibility of ID
function changeVisibility(divID) {
  let element = document.getElementById(divID);
  console.log(element.style.display);

  if (element) {
    if (element.style.display == "none" || element.style.display == "")
      element.style.display = "block";
    else element.style.display = "none";
  }
} // changeVisibility

function updateContents(data) {
  console.log(data.name);
  console.log(data);
  document.getElementById("name2").innerHTML = "Name: " + data.name;
  document.getElementById("connection2").innerHTML =
    "Connection: " + data.connection;
  if (data.connection == "Current Student") {
    document.getElementById("grade2").innerHTML = "Grade: " + data.grade;
  } else {
    document.getElementById("grade2").innerHTML = "Grade: Not a student";
  }
  document.getElementById("textInput2").innerHTML = data.textInput;
  document.getElementById("download").href =
    "profileimages/" + data.uid + "." + data.imagetype;
}

function displayLightBox(alt, imageFile) {
  let boundaryImageDiv = document.getElementById("boundaryBigImage");
  let textDiv = document.getElementById("text");
  let downloadButton = document.getElementById("download");
  let image = new Image();
  let bigImage = document.getElementById("bigImage");
  let requestedUid = imageFile.split(".")[0];
  currentUid = requestedUid;

  console.log(requestedUid);
  // update big image to access
  if (imageFile != "") {
    fetch(
      "http://142.31.53.220/~droppingfries/WeRam/getData.php?uid=" +
        requestedUid
    )
      .then((response) => response.json())
      .then((data) => updateContents(data))
      .catch((err) => console.log("error occurred " + err));
  }

  image.src = "profileimages/" + imageFile;
  image.alt = alt;

  // force big image to preload so we can have access
  // to it's width so it will be centered in the page
  image.onload = function () {
    var width = image.width;
    boundaryImageDiv.style.width = width + "px";
  };

  bigImage.src = image.src; // put big image in page
  bigImage.alt = image.alt;

  // show light box with big image
  changeVisibility("lightbox");
  changeVisibility("positionBigImage");
}

window.onload = function () {
  loadImages("all");
};

function loadImages(access) {
  fetch("./readjson.php?access=" + access)
    .then(function (resp) {
      return resp.json();
    })
    .then(function (data) {
      console.log(data);
      let i; // counter
      let main = document.getElementById("main");

      // remove all existing children of main
      while (main.firstChild) {
        main.removeChild(main.firstChild);
      }

      globalJsonData = data;

      // for every image, create a new image object and add to main
      for (i in data) {
        let img = new Image();
        let card = document.createElement("div");
        card.className = "card";
        card.setAttribute(
          "onclick",
          "displayLightBox('alt', '" +
            data[i].uid +
            "." +
            data[i].imagetype +
            "')"
        );
        console.log(data[i].uid + "." + data[i].imagetype);
        img.src = "thumbnails/" + data[i].uid + "." + data[i].imagetype;
        img.alt = data[i].desc;
        img.className = "thumb";
        main.appendChild(card).appendChild(img);
      }
    });
} // loadImages

function search() {
  let request = document.getElementById("search").value;
  fetch("./readjson.php?request=" + request)
    .then((response) => response.json())
    .then(function (data) {
      // console.log(data);
      let i; // counter
      let main = document.getElementById("main");

      // remove all existing children of main
      while (main.firstChild) {
        main.removeChild(main.firstChild);
      }

      for (i in data) {
        let img = new Image();
        let card = document.createElement("div");
        card.className = "card";
        card.setAttribute(
          "onclick",
          "displayLightBox('alt', '" +
            data[i].uid +
            "." +
            data[i].imagetype +
            "')"
        );
        console.log(data[i].uid + "." + data[i].imagetype);
        img.src = "thumbnails/" + data[i].uid + "." + data[i].imagetype;
        img.alt = data[i].desc;
        img.className = "thumb";
        main.appendChild(card).appendChild(img);
      }

      /*
      // for every image, create a new image object and add to main
      for (i in data){
        let img = new Image();
        console.log(img.src);
        img.src = "thumbnails/" + data[i].UID + "." + data[i].imagetype;
        img.alt = data[i].UID;
		console.log(data[i].uid + "." + data[i].imagetype);
		
		let newDiv = document.createElement("div");
		newDiv.setAttribute("class", "card");
		newDiv.setAttribute("onclick", "displayLightBox('" + data[i].UID + "." + data[i].imagetype + "', '" + data[i].UID + "." + data[i].imagetype + "')");
		newDiv.innerHTML = "<img class='thumb' src='" + img.src + "' alt='" + img.alt + "'>";
		main.appendChild(newDiv);
      }*/
    });
}

function changeImage(direction) {
  let current;
  let i;

  for (i in globalJsonData) {
    if (globalJsonData[i].uid == currentUid) {
      current = i;
      break;
    }
  }

  console.log("current: " + current);
  // 1 means right, 0 means left

  if (direction == 1) {
    current++;
    if (current < globalJsonData.length) {
      console.log("this code is running r " + current);
      displayLightBox("", "");
      displayLightBox(
        "alt",
        globalJsonData[current].uid + "." + globalJsonData[current].imagetype
      );
      currentUid = globalJsonData[current].uid;
    }
  } else {
    current--;
    if (current > -1) {
      console.log("this code is running l " + current);
      displayLightBox("", "");
      displayLightBox(
        "alt",
        globalJsonData[current].uid + "." + globalJsonData[current].imagetype
      );
      currentUid = globalJsonData[current].uid;
    }
  }
}
