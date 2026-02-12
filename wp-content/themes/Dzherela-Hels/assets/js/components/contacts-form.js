/**
 * Contacts Form Handler
 * Handles phone masking, validation, and submit state for the contacts section form
 */

class ContactsForm {
  constructor() {
    // Form is inside .contacts__form
    this.form = document.querySelector('.contacts__form form');

    if (!this.form) return;

    this.submitBtn = this.form.querySelector('.contacts-form__button');
    this.submitBtnText = this.submitBtn?.querySelector('.btn__text');
    this.originalBtnText = this.submitBtnText?.textContent || 'Записатись на консультацію';

    this.init();
  }

  init() {
    this.renameInputs();
    this.initPhoneMask();
    this.initValidation();
    this.initSubmitHandler();
  }

  /**
   * Rename inputs to match required output format
   */
  renameInputs() {
    const nameInput = this.form.querySelector('input[name="name"]');
    if (nameInput) nameInput.name = "Ім'я";

    const phoneInput = this.form.querySelector('input[name="phone"]');
    if (phoneInput) phoneInput.name = "Телефон";
  }

  /**
   * Initialize phone input mask (+38 format)
   */
  initPhoneMask() {
    const phoneInput = this.form.querySelector('input[type="tel"], input[name="phone"], input[name="Телефон"]');
    if (!phoneInput) return;

    // Set initial value
    if (!phoneInput.value || phoneInput.value.length < 4) {
      phoneInput.value = '+38 ';
    }

    phoneInput.addEventListener('input', (e) => {
      let value = e.target.value.replace(/\D/g, '');

      // Ensure starts with 38
      if (!value.startsWith('38')) {
        value = '38' + value;
      }

      // Limit to 12 digits (38 + 10 digits)
      value = value.substring(0, 12);

      // Format: +38 (0XX) XXX-XX-XX
      let formatted = '+';
      if (value.length > 0) formatted += value.substring(0, 2);
      if (value.length > 2) formatted += ' (' + value.substring(2, 5);
      if (value.length > 5) formatted += ') ' + value.substring(5, 8);
      if (value.length > 8) formatted += '-' + value.substring(8, 10);
      if (value.length > 10) formatted += '-' + value.substring(10, 12);

      e.target.value = formatted;
    });

    // Prevent cursor from going before +38 and prevent deletion
    phoneInput.addEventListener('keydown', (e) => {
      const cursorPos = e.target.selectionStart;
      if (cursorPos <= 4 && (e.key === 'Backspace' || e.key === 'Delete')) {
        e.preventDefault();
      }
    });

    // Focus handler - ensure cursor is at end
    phoneInput.addEventListener('focus', (e) => {
      setTimeout(() => {
        const len = e.target.value.length;
        e.target.setSelectionRange(len, len);
      }, 0);
    });
  }

  /**
   * Initialize form validation
   */
  initValidation() {
    // Clear invalid state on input
    const inputs = this.form.querySelectorAll('.contacts-form__input');
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        input.classList.remove('is-invalid');
      });
    });
  }

  /**
   * Initialize submit handler
   */
  initSubmitHandler() {
    this.form.addEventListener('submit', (e) => {
      if (!this.validateForm()) {
        e.preventDefault();
        e.stopPropagation();
        return;
      }

      // Show loading state
      this.setLoadingState(true);

      // Listen for reIntegration success (custom event or redirect)
      // Fallback: reset after timeout if form doesn't redirect
      setTimeout(() => {
        this.resetForm();
      }, 5000);
    });

    // Listen for reIntegration AJAX success if available
    document.addEventListener('reintegration:success', () => {
      this.resetForm();
    });
  }

  /**
   * Set button loading state
   * @param {boolean} loading - loading state
   */
  setLoadingState(loading) {
    if (!this.submitBtn || !this.submitBtnText) return;

    if (loading) {
      this.submitBtnText.textContent = 'Запис на консультацію...';
      this.submitBtn.disabled = true;
      this.submitBtn.style.opacity = '0.7';
      this.submitBtn.style.pointerEvents = 'none';
    } else {
      this.submitBtnText.textContent = this.originalBtnText;
      this.submitBtn.disabled = false;
      this.submitBtn.style.opacity = '';
      this.submitBtn.style.pointerEvents = '';
    }
  }

  /**
   * Reset form after successful submission
   */
  resetForm() {
    // Reset inputs
    const inputs = this.form.querySelectorAll('.contacts-form__input');
    inputs.forEach(input => {
      if (input.type === 'tel' || input.name === 'phone' || input.name === 'Телефон') {
        input.value = '+38 ';
      } else if (input.name === 'name' || input.name === "Ім'я") {
        input.value = '';
      }
      input.classList.remove('is-invalid');
    });

    // Reset button state
    this.setLoadingState(false);
  }

  /**
   * Validate all required form fields
   * @returns {boolean} - validation result
   */
  validateForm() {
    const inputs = this.form.querySelectorAll('.contacts-form__input[required]');
    let isValid = true;
    let firstInvalid = null;

    inputs.forEach(input => {
      input.classList.remove('is-invalid');

      const value = input.value.trim();

      // For phone, check if it's strictly digits other than prefix
      if (input.type === 'tel' || input.name === 'phone' || input.name === 'Телефон') {
        const phoneDigits = value.replace(/\D/g, '');
        if (phoneDigits.length !== 12) {
          isValid = false;
          input.classList.add('is-invalid');
          if (!firstInvalid) firstInvalid = input;
        }
      } else if (input.name === 'name' || input.name === "Ім'я") {
        // Валідація для поля "Ім'я"
        if (!value || value.length < 2) {
          isValid = false;
          input.classList.add('is-invalid');
          if (!firstInvalid) firstInvalid = input;
        }
      }
    });

    if (!isValid && firstInvalid) {
      firstInvalid.focus();
    }

    return isValid;
  }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
  new ContactsForm();
});

export default ContactsForm;
