// ==========================
// Door Elements
// ==========================

const door = document.getElementById("door");

const doorStatus = document.getElementById("door-status");

const relayStatus = document.getElementById("relay-status");


// ==========================
// OPEN DOOR
// ==========================

async function openDoor() {

    try {

        const response = await fetch("/api/door/open", {

            method: "POST"

        });

        const result = await response.json();

        if (result.status === "open") {

            door.classList.add("door-open");

            doorStatus.innerHTML = "🔓 OPEN";

            relayStatus.innerHTML = "🟢 ON";

        }

    }

    catch(error){

        alert("Door API Error");

        console.log(error);

    }

}



// ==========================
// CLOSE DOOR
// ==========================

async function closeDoor() {

    try {

        const response = await fetch("/api/door/close", {

            method: "POST"

        });

        const result = await response.json();

        if(result.status === "closed"){

            door.classList.remove("door-open");

            doorStatus.innerHTML = "🔒 CLOSED";

            relayStatus.innerHTML = "🔴 OFF";

        }

    }

    catch(error){

        alert("Door API Error");

        console.log(error);

    }

}