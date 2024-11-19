document.getElementById("signupButton").addEventListener("click", function () {
    var serviceType = document.getElementById("serviceprovider").value;
    var url = "";
    switch (serviceType) {
        case "hotel":
            url = "signup/hotel";
            break;
        case "restaurant":
            url = "signup/restaurant";
            break;
        case "heritagemarket":
            url = "signup/heritagemarket";
            break;
        case "culturaleventorg":
            url = "signup/culturaleventorganizer";
            break;
        default:
            alert("Please select a service type.");
            return;
    }
    window.location.href = url;
});
