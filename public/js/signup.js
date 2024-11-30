document.getElementById("signupButton").addEventListener("click", function () {
    var serviceType = document.getElementById("serviceprovider").value;
    var url = "";
    switch (serviceType) {
        case "hotel":
            url = "signup?user=hotel";
            break;
        case "restaurant":
            url = "signup?user=restaurant";
            break;
        case "heritagemarket":
            url = "signup?user=heritagemarket";
            break;
        case "culturaleventorg":
            url = "signup?user=culturaleventorganizer";
            break;
        default:
            alert("Please select a service type.");
            return;
    }
    window.location.href = url;
});
