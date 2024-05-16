/// <reference types="cypress" />

describe('welcome view', () => {
    beforeEach(() => {
        cy.useTestingDatabase();
        cy.visit(Cypress.config('baseUrl'));
    });

    it('should have a link to login', () => {
        cy.get(`a[href="${Cypress.config('baseUrl')}/login"]`).should('contain.text', 'Log in');
    });

    it('should have a link to register', () => {
        cy.get(`a[href="${Cypress.config('baseUrl')}/register"]`).should('contain.text', 'Register');
    });
});
