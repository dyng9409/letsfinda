module.exports = {
    'Testing Site': function (test) {
        test
            .open('http://localhost:8000/letsfinda.html')
            .assert.title().is('Letsfinda ...', 'It has title')
            .type('#autocomplete', 'Denver, CO, United States')
            .assert.val('#autocomplete', 'Denver, CO, United States', 'Text Field AcceptS Input')
            .click('#dateinput')
            .assert.val('#dateinput', '06-26-2015', 'Date Field Populates')
            .type('#money', '10.00')
            .assert.val('#money', '10.00', 'Price Field Populates')
            .sendKeys('#money','\uE013')
            .assert.val('#money', '10.01', 'Increment price works')
            .sendKeys('#money','\uE015')
            .assert.val('#money', '10', 'Decrement price works')
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

