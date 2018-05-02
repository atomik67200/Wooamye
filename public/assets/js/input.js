var trueInput = document.querySelector("#FakeInput1 input"),
    fakeInput = document.querySelector("#FakeInput1 span:first-child");

/*trueInput.addEventListener("change", function(){
    fakeInput.innerHTML = trueInput.value;
}, false);*/

Array.from('FakeInput').forEach(function(element){
    element.addEventListener("change", function(){
        fakeInput.innerHTML = trueInput.value;
    }, false);
});