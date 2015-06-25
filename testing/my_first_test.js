module.exports = {
    'Testing Site': function (test) {
        test
            .open('http://localhost:8000/letsfinda.html')
            .assert.title().is('Letsfinda ...', 'It has title')
            .type('#autocomplete', 'Denver, CO, United States')
            .assert.val('#autocomplete', 'Denver, CO, United States', 'Text Field AcceptS Input')
            .click('#dateinput')
            .assert.val('#dateinput', '06-25-2015', 'Date Field Populates')
            .click('#flat')
            .accept()
            .done();

    }
   /* 
    'Autocompletion': function (test) {
        test
            .open('http://localhost:8000/letsfinda.html')
            .type('#autocomplete', 'den')
            .sendKeys('body','\u001B\u005B\u0042')
            .sendKeys('body','\uE006')
            .assert.val('#autocomplete', 'Denver', 'Autocomplete Worked')
            .done();
    }
   */ 
};

