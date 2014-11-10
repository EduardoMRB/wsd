var Browser = require("zombie");
var assert = require("assert");
browser = new Browser()
describe("Deve inserir um novo apartamento", function() {
    before(function(done) {
        browser.visit("http://localhost/sistema/apartamento/new", function () {
            browser.
            fill('#morador', 'Vera veronica').
            fill('#numero', '407').
            fill('#saldo', '600').
            fill('#meses', 'Agosto').
            pressButton("Guardar", done);
        });
    });
    
    it("Deve retornar mensagem de sucesso", function() {
        var expect = browser.text('.text-success');
        assert.equal(expect , "Dados inseridos com sucesso");
    });
});
