(function () {
    "use strict";

    const pickrContainer = document.querySelector('.pickr-container');
    const themeContainer = document.querySelector('.theme-container');
    const pickrContainer1 = document.querySelector('.pickr-container1');
    const themeContainer1 = document.querySelector('.theme-container1');
    const pickrContainer2 = document.querySelector('.pickr-container2');
    const themeContainer2 = document.querySelector('.theme-container2');

    /* classic */
    const themes = [
        [
            'classic',
            {
                switches: [
                    'rgba(244, 67, 54, 1)',
                    'rgba(233, 30, 99, 0.95)',
                    'rgba(156, 39, 176, 0.9)',
                    'rgba(103, 58, 183, 0.85)',
                    'rgba(63, 81, 181, 0.8)',
                    'rgba(33, 150, 243, 0.75)',
                    'rgba(3, 169, 244, 0.7)',
                    'rgba(0, 188, 212, 0.7)',
                    'rgba(0, 150, 136, 0.75)',
                    'rgba(76, 175, 80, 0.8)',
                    'rgba(139, 195, 74, 0.85)',
                    'rgba(205, 220, 57, 0.9)',
                    'rgba(255, 235, 59, 0.95)',
                    'rgba(255, 193, 7, 1)'
                ],

                components: {
                    preview: true,
                    opacity: true,
                    hue: true,

                    interaction: {
                        hex: true,
                        rgba: true,
                        hsva: true,
                        input: true,
                        clear: true,
                        save: true
                    }
                }
            }
        ],
    ];

    const buttons = [];
    let pickr = null;

    for (const [theme, config] of themes) {
        const button = document.createElement('button');
        button.innerHTML = theme;
        buttons.push(button);

        button.addEventListener('click', () => {
            const el = document.createElement('p');
            pickrContainer.appendChild(el);

            // Delete previous instance
            if (pickr) {
                pickr.destroyAndRemove();
            }

            // Apply active class
            for (const btn of buttons) {
                btn.classList[btn === button ? 'add' : 'remove']('active','ti-btn' ,'ti-btn-primary-full');
            }

            // Create fresh instance
            pickr = new Pickr(Object.assign({
                el,
                theme,
                default: '#a68e5e'
            }, config));

            // Set events
            pickr.on('init', instance => {
            }).on('hide', instance => {
            }).on('show', (color, instance) => {
            }).on('save', (color, instance) => {
            }).on('clear', instance => {
            }).on('change', (color, source, instance) => {
            }).on('changestop', (source, instance) => {
            }).on('cancel', instance => {
            }).on('swatchselect', (color, instance) => {
            });
        });

        themeContainer.appendChild(button);
    }

    buttons[0].click();

    /* monolith */
    const monolithThemes = [
        [
            'monolith',
            {
                switches: [
                    'rgba(244, 67, 54, 1)',
                    'rgba(233, 30, 99, 0.95)',
                    'rgba(156, 39, 176, 0.9)',
                    'rgba(103, 58, 183, 0.85)',
                    'rgba(63, 81, 181, 0.8)',
                    'rgba(33, 150, 243, 0.75)',
                    'rgba(3, 169, 244, 0.7)'
                ],

                defaultRepresentation: 'HEXA',
                components: {
                    preview: true,
                    opacity: true,
                    hue: true,

                    interaction: {
                        hex: false,
                        rgba: false,
                        hsva: false,
                        input: true,
                        clear: true,
                        save: true
                    }
                }
            }
        ]
    ];

    const monolithButtons = [];
    let monolithPickr = null;

    for (const [theme, config] of monolithThemes) {
        const button = document.createElement('button');
        button.innerHTML = theme;
        monolithButtons.push(button);

        button.addEventListener('click', () => {
            const el = document.createElement('p');
            pickrContainer1.appendChild(el);

            /* Delete previous instance */
            if (monolithPickr) {
                monolithPickr.destroyAndRemove();
            }

            /* Apply active class */
            for (const btn of monolithButtons) {
                btn.classList[btn === button ? 'add' : 'remove']('active','ti-btn' ,'ti-btn-primary-full');
            }

            /* Create fresh instance */
            monolithPickr = new Pickr(Object.assign({
                el,
                theme,
                default: '#d5dde7'
            }, config));

            /* Set events */
            monolithPickr.on('init', instance => {
            }).on('hide', instance => {
            }).on('show', (color, instance) => {
            }).on('save', (color, instance) => {
            }).on('clear', instance => {
            }).on('change', (color, source, instance) => {
            }).on('changestop', (source, instance) => {
            }).on('cancel', instance => {
            }).on('swatchselect', (color, instance) => {
            });
        });

        themeContainer1.appendChild(button);
    }

    monolithButtons[0].click();

    //nano
    const nanoThemes = [
        [
            'nano',
            {
                switches: [
                    'rgba(244, 67, 54, 1)',
                    'rgba(233, 30, 99, 0.95)',
                    'rgba(156, 39, 176, 0.9)',
                    'rgba(103, 58, 183, 0.85)',
                    'rgba(63, 81, 181, 0.8)',
                    'rgba(33, 150, 243, 0.75)',
                    'rgba(3, 169, 244, 0.7)'
                ],

                defaultRepresentation: 'HEXA',
                components: {
                    preview: true,
                    opacity: true,
                    hue: true,

                    interaction: {
                        hex: false,
                        rgba: false,
                        hsva: false,
                        input: true,
                        clear: true,
                        save: true
                    }
                }
            }
        ]
    ];

    const nanoButtons = [];
    let nanoPickr = null;

    for (const [theme, config] of nanoThemes) {
        const button = document.createElement('button');
        button.innerHTML = theme;
        nanoButtons.push(button);

        button.addEventListener('click', () => {
            const el = document.createElement('p');
            pickrContainer2.appendChild(el);

            /* Delete previous instance */
            if (nanoPickr) {
                nanoPickr.destroyAndRemove();
            }

            /* Apply active class */
            for (const btn of nanoButtons) {
                btn.classList[btn === button ? 'add' : 'remove']('active','ti-btn' ,'ti-btn-primary-full');
            }

            /* Create fresh instance */
            nanoPickr = new Pickr(Object.assign({
                el,
                theme,
                default: '#b95d4b'
            }, config));

            /* Set events */
            nanoPickr.on('init', instance => {
            }).on('hide', instance => {
            }).on('show', (color, instance) => {
            }).on('save', (color, instance) => {
            }).on('clear', instance => {
            }).on('change', (color, source, instance) => {
            }).on('changestop', (source, instance) => {
            }).on('cancel', instance => {
            }).on('swatchselect', (color, instance) => {
            });
        });

        themeContainer2.appendChild(button);
    }

    nanoButtons[0].click();

})();