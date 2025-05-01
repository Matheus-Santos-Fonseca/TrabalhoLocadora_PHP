function moveNext(currentInput, nextInputId, previousInputId) {
    if (currentInput.value.length === 1) {
        const nextInput = document.getElementById(nextInputId);
        if (nextInput) {
            nextInput.focus();
        }
    } else if (currentInput.value.length === 0 && previousInputId) {
        const previousInput = document.getElementById(previousInputId);
        if (previousInput) {
            previousInput.focus();
        }
    }
}