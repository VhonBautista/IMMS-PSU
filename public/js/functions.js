function setDeleteFormAction(hiddenInputFieldId, dataValue) 
{
    document.getElementById(hiddenInputFieldId).value = dataValue;
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

function setDeleteCollegeFormAction(collegeId) {
    document.getElementById('college-id-input').value = collegeId;
}



