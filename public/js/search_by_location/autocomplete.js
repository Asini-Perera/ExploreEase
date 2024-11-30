let availableKeywords = [
    'Colombo','Battaramulla'  ,'Dabulla'  ,'maharagama'  ,'Kotikawatta'  ,'Anuradhapura'  ,'Vavuniya'  ,'Kolonnawa'  ,'Hendala'  ,'Rathnapura'  ,'Ella'  ,'Colombo'  ,'Kandy'  ,'Galle'  ,'Matara'  ,'Kurunegala'  ,'Negombo'  ,'Kadawatha','Nugegoda','Kaduwela','Piliyandala','Moratuwa','Panadura','Kalutara','Gampaha','Minuwangoda','Kadawatha','Negombo','Wattala',
];

const resultBox = document.querySelector(".result-box");
const searchInput = document.getElementById("search-bar");

searchInput.onkeyup = function(){
    let result = [];
    let userInput = searchInput.value;

    if(userInput.length){
        result = availableKeywords.filter((keyword) => {
           return keyword.toLowerCase().includes(userInput.toLowerCase());
        });

        console.log(result);
    }
    display(result);

    if(!result.length){
        resultBox.innerHTML = '';
    }
}

function display(result){
    const content = result.map((list) =>{
        return "<li onclick=selectInput(this)>" + list +"</li>";
    });

    resultBox.innerHTML = "<ul>" +content.join('')+ "</ul>";
}

function selectInput(list){
    searchInput.value = list.innerHTML;
    resultBox.innerHTML = '';
}