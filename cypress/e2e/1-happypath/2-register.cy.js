/// <reference types="cypress" />

describe('Register', () => {
    beforeEach(() => {
        cy.useTestingDatabase();
        cy.visit(Cypress.config('baseUrl') + "/register")
    })

    it('allows user to register', () => {
        cy.get('input[id="name"]').type('Cypress Name')
        cy.get('input[id="email"]').type('cypress@example.com')
        cy.get('input[id="password"]').type('asdfasdf')
        cy.get('input[id="password_confirmation"]').type('asdfasdf')

        // Submit the registration form
        cy.contains('button', 'Register').click()

        cy.url().should('include', '/dashboard')

        cy.contains('button', "Cypress Name").should('exist')
    })
})