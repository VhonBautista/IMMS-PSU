function updateSentence() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
    var sentence = checkedCheckboxes.map(checkbox => checkbox.value).join(', ');

    if (sentence.trim() === "") {
        sentence = "None";
    } else {
        sentence = sentence + '.';
    }

    document.getElementById("resubmit-passed-criteria").value = sentence;
    document.getElementById("display-resubmit-passed-criteria").textContent = sentence;
    document.getElementById("approve-passed-criteria").value = sentence;
    document.getElementById("display-approve-passed-criteria").textContent = sentence;
}

var checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        updateSentence();
    });
    var isChecked = localStorage.getItem(checkbox.id);

    if (isChecked === "true") {
        checkbox.checked = true;
    }
});

updateSentence();