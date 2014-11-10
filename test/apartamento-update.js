var Browser = require("zombie");
var assert = require("assert");
browser = new Browser()
describe("Deve atualizar os dados de um apartamento", function() {
    before(function(done) {
        browser.visit("http://localhost/sistema/apartamento/edit/1", function () {
            browser.
            fill('#morador', 'Joao neto 2').
            fill('#numero', '308').
            fill('#saldo', '11').
            fill('#meses', 'Agosto,Fevereiro').
            pressButton("Actualizar", done);
        });
    });
    
    it("Deve retornar mensagem de sucesso", function() {
        var expect = browser.text('.text-success');
        assert.equal(expect , "Dados do morador atualizado com sucesso");
    });
});
