const translations = {
    en: {
        reg_title: 'Create an account',
        reg_sub: 'Welcome aboard.',
        log_title: 'Login to your account',
        log_sub: 'Let\'s jump in.'
    },
    fr: {
        reg_title: 'Créer un compte',
        reg_sub: 'Bienvenue.',
        log_title: 'Connexion au compte',
        log_sub: 'C\'est parti.'
    }
};

function setTranslateListener(){
    document.querySelector('#translate-button').addEventListener('click', () => {
        clickedLanguageButton();
    });
}

function clickedLanguageButton(){
    switchLanguage();
    updateLanguage();
}

function initLanguage(){
    let language = localStorage.getItem('language');
    if (language === null) {
        console.log("No language selected. Set to fr")
        language = 'fr';
        localStorage.setItem('language', language);
    }
    updateLanguage();
}

function switchLanguage() {
    let language = localStorage.getItem('language');
    if(language === 'en'){
        language = 'fr';
    } else {
        language = 'en';
    }
    localStorage.setItem('language', language);
    console.log("Language changed to " + language);
    document.documentElement.lang = language;
}
function updateLanguage() {
    let lang = localStorage.getItem('language')
    console.log("Refreshing text to " + lang);
    const elements = document.querySelectorAll('[data-translate]');
    elements.forEach(element => {
        const key = element.getAttribute('data-translate');
        if (translations[lang][key]) {
            element.textContent = translations[lang][key];
        }
    });
}

initLanguage();
setTranslateListener();

