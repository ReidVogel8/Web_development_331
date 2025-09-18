window.addEventListener("DOMContentLoaded", domLoaded);

// When the DOM has finished loading, add the event listeners.
function domLoaded() {
    // TODO: Use addEventListener() to register a click event handler for the convert button.
    // https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener#add_a_simple_listener
    document.getElementById("convertButton").addEventListener("click", convertTemp);

    // Add event listeners to handle clearing the box that WAS NOT clicked,
    // e.g., the element C_in listens for 'input', with a callback fn to
    // execute after that event does happen.
    // You don't send arguments to the event handler function.
    // So, if you want the event handler to call another function that
    // DOES take arguments, you can send that other function as a callback.
    // https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener#event_listener_with_anonymous_function
    // Here is an example of anonymous event handler fn that calls alert with an argument:
    // document.getElementById("weatherIcon").addEventListener("click", function() {alert("You clicked the icon.")})

    document.getElementById("C_input").addEventListener("input", function() {
        document.getElementById("F_input").value = "";
    });

    document.getElementById("F_input").addEventListener("input", function() {
        document.getElementById("C_input").value = "";
    });
}
// TODO: (Part of the above is to write the functions to be executed when the event handlers are invoked.)

function convertCtoF(C) {
    // TODO: Return temp in °F.
    F = C * 9/5 + 32;
    return F;
}

function convertFtoC(F) {
    // TODO: Return temp in °C
    C = (F - 32) * 5/9;
    return C;
}

// TODO: write a fn that can be called with every temp conversion
// to display the correct weather icon.
// Based on degrees Fahrenheit:
// 32 or less, but above -200: cold
// 90 or more, but below 200: hot
// between hot and cold: cool
// 200 or more, -200 or less: dead
// both input fields are blank: C-F

function setWeather(F) {
    let icon = document.getElementById("weatherIcon");

    if (isNaN(F)) {
        icon.src = "images/C-F.png";
        icon.alt = "C and F";
    } else if (F <= 32 && F > -200) {
        icon.src = "images/cold.png";
        icon.alt = "Cold";
    } else if (F >= 90 && F < 200) {
        icon.src = "images/hot.png";
        icon.alt = "Hot";
    } else if (F > 32 && F < 90) {
        icon.src = "images/cool.png";
        icon.alt = "Cool";
    } else {
        icon.src = "images/dead.png";
        icon.alt = "Dead";
    }
}

function convertTemp() {
    let F_input = document.getElementById("F_input").value;
    let C_input = document.getElementById("C_input").value;
    let message = document.getElementById("message");

    if (F_input === "" && C_input === "") {
        message.textContent = "Enter a temperature to convert.";
        setWeather(NaN);
        return;
    }

    if (F_input !== "") {
        let F = parseFloat(F_input);
        let C = convertFtoC(F);
        document.getElementById("C_input").value = C.toFixed(2);
        message.textContent = "";
        setWeather(F);
    } else if (C_input !== "") {
        let C = parseFloat(C_input);
        let F = convertCtoF(C);
        document.getElementById("F_input").value = F.toFixed(2);
        message.textContent = C + "°C is " + F.toFixed(2) + "°F";
        setWeather(F);
    }
}
