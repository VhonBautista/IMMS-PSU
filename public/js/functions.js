function setDeleteFormAction(hiddenInputFieldId, dataValue) 
{
    document.getElementById(hiddenInputFieldId).value = dataValue;
}

function setDoubleFormAction(hiddenInputFieldId, dataValue, hiddenInputFieldIdTwo, dataValueTwo) 
{
    document.getElementById(hiddenInputFieldId).value = dataValue;
    document.getElementById(hiddenInputFieldIdTwo).value = dataValueTwo;
}

function setCourseCollegeFormAction(titleFieldId, titleValue, hiddenInputFieldId, idValue) 
{
    document.getElementById(titleFieldId).textContent = 'Add Courses to ' + titleValue;
    document.getElementById(hiddenInputFieldId).value = idValue;

    fetch('get-courses-for-college/' + idValue)
        .then(response => response.text())
        .then(data => {
            document.getElementById('dynamicContentContainer').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function setMatrixFormAction(hiddenInputFieldId, idValue) 
{
    document.getElementById(hiddenInputFieldId).value = idValue;
}

function setEvaluatorFormAction(hiddenInputFieldId, button) {
    let idValue = button.getAttribute('data-matrix-id');
    let url = button.getAttribute('data-url')
    
    document.getElementById(hiddenInputFieldId).value = idValue;

    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('dynamicContentContainer').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}