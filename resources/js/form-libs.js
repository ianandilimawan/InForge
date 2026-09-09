/**
 * Form Component Libraries (bundled via NPM instead of CDN)
 * These are imported in form pages via @vite directive
 */

// TinyMCE Rich Text Editor
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver';
import 'tinymce/icons/default';
import 'tinymce/models/dom';
window.tinymce = tinymce;

// TinyMCE Free Plugins
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/code';
import 'tinymce/plugins/codesample';
import 'tinymce/plugins/directionality';
import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/help';
import 'tinymce/plugins/image';
import 'tinymce/plugins/insertdatetime';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/media';
import 'tinymce/plugins/nonbreaking';
import 'tinymce/plugins/pagebreak';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/table';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/visualchars';
import 'tinymce/plugins/wordcount';

// TomSelect (searchable select)
import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.default.min.css';
window.TomSelect = TomSelect;

// Tagify (tag input)
import Tagify from '@yaireo/tagify';
import '@yaireo/tagify/dist/tagify.css';
window.Tagify = Tagify;

// AutoNumeric (currency formatting)
import AutoNumeric from 'autonumeric';
window.AutoNumeric = AutoNumeric;

// Global AutoNumeric auto-initialization for input[data-currency]
export function initCurrencyInputs(root = document) {
    if (typeof AutoNumeric === 'undefined') return;
    const currencyInputs = (root || document).querySelectorAll('input[data-currency], input[data-currency="true"]');
    currencyInputs.forEach(input => {
        try {
            let instance = AutoNumeric.getAutoNumericElement(input);
            if (!instance) {
                const currentValue = input.value || '';
                const rawValue = currentValue.toString().replace(/[^\d.-]/g, '');

                instance = new AutoNumeric(input, {
                    digitGroupSeparator: '.',
                    decimalCharacter: ',',
                    decimalPlaces: 0,
                    currencySymbol: 'Rp ',
                    currencySymbolPlacement: 'p',
                    allowDecimalPadding: false,
                    minimumValue: '-999999999999',
                    maximumValue: '999999999999',
                    formatOnPageLoad: true,
                    unformatOnSubmit: true,
                    modifyValueOnWheel: false,
                    emptyInputBehavior: 'zero'
                });

                if (rawValue !== '' && rawValue !== null && !isNaN(rawValue)) {
                    instance.set(parseFloat(rawValue));
                }
            }
        } catch (e) {
            console.warn('Failed to initialize AutoNumeric on input:', input, e);
        }
    });
}

window.initCurrencyInputs = initCurrencyInputs;

if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => initCurrencyInputs());
    } else {
        initCurrencyInputs();
    }

    // Support dynamic re-initialization via custom event
    window.addEventListener('init-currency', () => initCurrencyInputs());

    // Unformat currency inputs before AJAX/standard form submission
    document.addEventListener('submit', (e) => {
        if (typeof AutoNumeric === 'undefined') return;
        const form = e.target;
        if (form && form.querySelectorAll) {
            form.querySelectorAll('input[data-currency], input[data-currency="true"]').forEach(input => {
                const an = AutoNumeric.getAutoNumericElement(input);
                if (an) {
                    const num = an.getNumber();
                    if (num !== null && num !== undefined) {
                        input.value = num;
                    }
                }
            });
        }
    }, true);
}

// Global TomSelect auto-initialization for select.select2 and select[data-searchable]
export function initTomSelectInputs(root = document) {
    if (typeof TomSelect === 'undefined') return;
    const selects = (root || document).querySelectorAll('select.select2, select[data-searchable]');
    selects.forEach(select => {
        if (select.tomselect) return;

        let placeholder = '';
        const firstOption = select.querySelector('option[value=""]');
        if (firstOption && firstOption.textContent.trim()) {
            placeholder = firstOption.textContent.trim();
        } else if (select.dataset.placeholder) {
            placeholder = select.dataset.placeholder;
        } else {
            placeholder = select.getAttribute('placeholder') || 'Search & select...';
        }

        const plugins = ['clear_button'];
        if (select.hasAttribute('multiple')) {
            plugins.push('remove_button');
        }

        window.tomSelectInstances = window.tomSelectInstances || {};
        try {
            const tsInstance = new TomSelect(select, {
                placeholder: placeholder,
                plugins: plugins,
                maxOptions: 100,
                create: false,
                render: {
                    no_results: function(data, escape) {
                        return '<div class="no-results px-3 py-2 text-xs text-zinc-400">No results found for "' + escape(data.input) + '"</div>';
                    }
                }
            });

            tsInstance.on('dropdown_open', () => {
                const parentContainer = select.closest('.rounded-2xl, section, [class*="card"]');
                if (parentContainer) {
                    parentContainer.style.zIndex = '50';
                }
            });

            tsInstance.on('dropdown_close', () => {
                const parentContainer = select.closest('.rounded-2xl, section, [class*="card"]');
                if (parentContainer) {
                    parentContainer.style.zIndex = '';
                }
            });

            window.tomSelectInstances[select.id || select.name] = tsInstance;
        } catch (e) {
            console.warn('Failed to initialize TomSelect on element:', select, e);
        }
    });
}

window.initTomSelectInputs = initTomSelectInputs;

if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => initTomSelectInputs());
    } else {
        initTomSelectInputs();
    }

    // Support dynamic re-initialization via custom event
    window.addEventListener('init-select', () => initTomSelectInputs());
}


