Element.prototype.alterLoading = function (isLoading, text = null, toggleButton = true) {
    if (this.tagName !== 'BUTTON' && this.classList.contains('loadable')) {
        if (toggleButton) {
            if (!isLoading) {
                this.removeAttribute('readonly');
            } else {
                this.setAttribute('readonly', true);
            }
        }

        this.classList.toggle('loading', isLoading);
        return;
    }

    if (isLoading) {
        this.dataset.originalContent = this.innerHTML;
        this.disabled = true;

        text = text || this.innerText;

        this.innerHTML = `<i class="fa fa-spinner fa-spin"></i> ${text}`;
        return;
    }

    this.innerHTML = this.dataset.originalContent;
    if (toggleButton) {
        this.disabled = false;
    }
}

Element.prototype.startLoading = function (text = null) {
    this.alterLoading(true, text);
}

Element.prototype.stopLoading = function (toggleButton = true) {
    this.alterLoading(false, null, toggleButton);
}

Element.prototype.loadable = function (config) {
    const elementContainerHtml = `<div class="element-container"></div>`;
    const iconContainerHtml = `<div class="icon-container"><i class="fa-light fa-spinner-third fa-spin" style="color: #9bc648;"></i></div>`;

    this.insertAdjacentHTML('afterend', elementContainerHtml);

    const elementContainer = this.nextElementSibling;
    elementContainer.appendChild(this);
    elementContainer.insertAdjacentHTML('beforeend', iconContainerHtml);
    if (this.tagName === 'SELECT') {
        if (this.classList.contains('simple')) {
            simpleSelect2Mask(this);
        } else {
            select2Mask(this);
        }
    }
}

Element.prototype.block = function (config = {}) {
    if (typeof config == 'string') {
        config = { message: config };
    }

    const message = config.message || 'Aguarde...';
    delete config.message;
    $(this).block({
        message: `
            <h5 class="text-primary">${message}</h5>
            <div class="sk-chase sk-center mt-5">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        `,
        ...config
    });
}

Element.prototype.unblock = function () {
    $(this).unblock();
}
