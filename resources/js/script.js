window.scan = function () {
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false
    });
    
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert("No cameras found.");
        }
    }).catch(function (e) {
        console.error(e);
    });
    
    scanner.addListener('scan', function (content) {
       document.getElementById.text = content;
       document.location.href = content;
    });

    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.log("getUserMedia not supported");
    } else {
        console.log("getUserMedia is supported");
    }
    
};

//copy uuid
window.copyUUID = function () {
   let text = document.getElementById("uuid").innerText;
    navigator.clipboard.writeText(text).then(() => {
        alert("UUID copied to clipboard!");
    }).catch(err => {
        console.error("Failed to copy UUID: ", err);
    });
}

//creation modal
window.confirmFirst = function showConfirmation() {
    const title = document.getElementById('title').value;
    const sender = document.getElementById('sender').value;
    const email = document.getElementById('email').value;
    const senderDept = document.getElementById('sender_dept').value;
    const recipientDept = document.getElementById('department').value;
    const commType = document.querySelector('input[name="communication"]:checked')?.value || 'Not selected';

    document.getElementById('previewText').innerHTML = `
        <strong>Document:</strong> ${title}<br>
        <strong>Sender:</strong> ${sender}<br>
        <strong>Sender's Email:</strong> ${email}<br>
        <strong>Sender Dept:</strong> ${senderDept}<br>
        <strong>Destination Dept:</strong> ${recipientDept}<br>
        <strong>Communication:</strong> ${commType}
    `;

    document.getElementById('confirmModal').style.display = 'block';
}

window.closeModal = function closeModal() {
    document.getElementById('confirmModal').style.display = 'none';
}

window.submitForm = function submitForm() {
    document.getElementById('qrForm').submit();
}

//qr creation form validation
window.validateForm = function(){
    const recipientDept = document.getElementById('department').value;
    const title = document.getElementById('title').value;

    var documentTitleError = document.getElementById('documentTitleError');
    var departmentError = document.getElementById('departmentError');
    var communicationError = document.getElementById('communicationError');    

    var isValid = true;

    var genericMsg = "You forgot to input ";
    
    if(!title){
        documentTitleError.textContent = genericMsg + "the document's title!";
        isValid = false;
    } else {
        documentTitleError.textContent = "";
    }

    if(!recipientDept){
        departmentError.textContent = genericMsg + "the receiving department!";
        isValid = false;
    } else{
        departmentError.textContent = "";
    }

    if(!document.querySelector('input[name="communication"]:checked')){
        communicationError.textContent = genericMsg + "the communication type!";
        isValid = false;
    } else{
        communicationError.textContent = "";
    }

    if(!isValid){
        return;
    }

    confirmFirst();
}


//delete document modal
window.deleteConfirmFirst = function(docUUID) {
    const intendedUUID = docUUID;
    const selectedUUID = intendedUUID.replace("doc-", "");

    console.log("The intended uuid to be deleted:", docUUID);
    const title = document.querySelector(`#title-${docUUID}`).textContent;
    const uuid = document.querySelector(`#doc-${docUUID}`).textContent;
    
    console.log(title);

    document.getElementById('previewText').innerHTML = `
        <strong>Document:</strong> ${title}<br>
        <strong>UUID:</strong> ${uuid}
    `;

    document.getElementById('deleteConfirmModal').style.display = 'block';

    window.submitFormDelete = function submitForm() {
        console.log("Delete button clicked for UUID:", selectedUUID); 
        console.log("Form ID:", document.getElementById('docDeleteForm-'+selectedUUID).id);
        document.querySelector(`#docDeleteForm-${selectedUUID}`).submit();
    }
}

window.closeModalDelete = function closeModal() {
    document.getElementById('deleteConfirmModal').style.display = 'none';
}


//status update modal
window.validateStatusForm = function validateStatusForm(){
    const status = document.getElementById('status').value;
    var statusUpdateError = document.getElementById('statusError');
    if(!status){
        statusUpdateError.textContent = "Status update cannot be null!";
        return
    }

    window.statusConfirmFirst();
}
window.statusConfirmFirst = function statusConfirmFirst() {
    const recipient = document.getElementById('recipient').value;
    const recipientEmail = document.getElementById('recipient_email').value;
    const recipientDept = document.getElementById('recipient_dept').value;
    const status = document.getElementById('status').value;
    const remarks = (document.getElementById('remarks').value) === ""? "*No Remarks Supplied" : document.getElementById('remarks').value;
    document.getElementById('previewStatusConfirm').innerHTML = `
        <strong>Recipient:</strong> ${recipient}<br>
        <strong>Recipient Email:</strong> ${recipientEmail}<br>
        <strong>Recipient Dept:</strong> ${recipientDept}<br>
        <strong>Status:</strong> ${status}<br>
        <strong>Remarks:</strong> <i>${remarks}</i>
    `;

    document.getElementById('statusConfirmModal').style.display = 'block';
}

window.statusCloseModal = function statusCloseModal() {
    document.getElementById('statusConfirmModal').style.display = 'none';
}

window.statusSubmitForm = function statusSubmitForm() {
    document.getElementById('statusSubmitForm').submit();
}