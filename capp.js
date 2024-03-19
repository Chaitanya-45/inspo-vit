function goToStep(step) {
    const steps = document.querySelectorAll('.path-step');
    steps.forEach((s, index) => {
        s.style.display = index + 1 === step ? 'block' : 'none';
    });
}