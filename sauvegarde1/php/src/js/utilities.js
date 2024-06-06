function showErrorMessage(message) {
    const errorMessageElement = document.getElementById('error-message');
    errorMessageElement.textContent = message;
    setTimeout(() => {
        errorMessageElement.textContent = '';
    }, 3000);
}
