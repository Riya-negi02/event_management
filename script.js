function confirmDelete() {
    return confirm('Are you sure you want to delete this event?');
}

function validateRegisterForm() {
    var password = document.getElementById('password').value;
    if(password.length < 6){
        alert('Password must be atleast 6 characters!');
        return false;
    }
    return true;
}